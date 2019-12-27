/*
define([
    'dojo/_base/declare',
    'davinci/html/HTMLText',
    'davinci/html/HTMLElement',
    'davinci/html/HTMLAttribute',
    'davinci/html/HTMLComment',
    'davinci/html/PHPBlock',
    'davinci/model/parser/Tokenizer',
    'davinci/html/CSSParser'
], (
    declare,
    HTMLText,
    HTMLElement,
    HTMLAttribute,
    HTMLComment,
    PHPBlock,
    Tokenizer,
    CSSParser
) => {
*/
/* This file defines an XML parser, with a few kludges to make it
 * useable for HTML. autoSelfClosers defines a set of tag names that
 * are expected to not have a closing tag, and doNotIndent specifies
 * the tags inside of which no indentation should happen (see Config
 * object). These can be disabled by passing the editor an object like
 * {useHTMLKludges: false} as parserConfig option.
 */
let indentUnit = 1;
import { HTMLElement, HTMLAttribute, HTMLComment, Tokenizer, CSSParser, HTMLText } from './';
const XMLParser = ((() => {
    const Kludges = {
        autoSelfClosers: {
            br: true, img: true, hr: true, link: true, input: true,
            meta: true, col: true, frame: true, base: true, area: true
        },
        doNotIndent: { 'pre': true, '!cdata': true }
    };
    const NoKludges = {
        autoSelfClosers: {

        },
        doNotIndent: {
            '!cdata': true
        }
    };
    let UseKludges = Kludges;
    let alignCDATA = false;

    // Simple stateful tokenizer for XML documents. Returns a
    // MochiKit-style iterator, with a state property that contains a
    // function encapsulating the current state. See tokenize.js.
    const tokenizeXML = ((() => {
        function inText(source, setState) {
            const ch = source.next();
            if (ch == '<') {
                if (source.equals('!')) {
                    source.next();
                    if (source.equals('[')) {
                        if (source.lookAhead('[CDATA[', true)) {
                            setState(inBlock('xml-cdata', ']]>'));
                            return null;
                        } else {
                            return 'xml-text';
                        }
                    } else if (source.lookAhead('--', true)) {
                        setState(inBlock('xml-comment', '-->'));
                        return null;
                    } else if (source.lookAhead('DOCTYPE', true)) {
                        source.nextWhileMatches(/[\w\._\-]/);
                        setState(inBlock('xml-doctype', '>'));
                        return 'xml-doctype';
                    } else {
                        return 'xml-text';
                    }
                } else if (source.equals('?')) {
                    source.next();
                    if (source.lookAhead('php', true/*consume*/, false/*skipSpaces*/, true/*caseInsensitive*/)) {
                        setState(inIgnore('php-block', '?>'));
                        return null;
                    } else {
                        source.nextWhileMatches(/[\w\._\-]/);
                        setState(inBlock('xml-processing', '?>'));
                        return 'xml-processing';
                    }
                } else {
                    if (source.equals('/')) { source.next(); }
                    setState(inTag);
                    return 'xml-punctuation';
                }
            } else if (ch == '&') {
                while (!source.endOfLine()) {
                    if (source.next() == ';') {
                        break;
                    }
                }
                return 'xml-entity';
            } else {
                source.nextWhileMatches(/[^&<\n]/);
                return 'xml-text';
            }
        }

        function inTag(source, setState) {
            const ch = source.next();
            if (ch == '>') {
                setState(inText);
                return 'xml-punctuation';
            } else if (/[?\/]/.test(ch) && source.equals('>')) {
                source.next();
                setState(inText);
                return 'xml-punctuation';
            } else if (ch == '=') {
                return 'xml-punctuation';
            } else if (/[\'\"]/.test(ch)) {
                setState(inAttribute(ch));
                return null;
            } else {
                source.nextWhileMatches(/[^\s\u00a0=<>\"\'\/?]/);
                return 'xml-name';
            }
        }

        function inAttribute(quote) {
            return (source, setState) => {
                while (!source.endOfLine()) {
                    if (source.next() == quote) {
                        setState(inTag);
                        break;
                    }
                }
                return 'xml-attribute';
            };
        }

        function inBlock(style, terminator) {
            return (source, setState) => {
                while (!source.endOfLine()) {
                    if (source.lookAhead(terminator, true)) {
                        setState(inText);
                        break;
                    }
                    source.next();
                }
                return style;
            };
        }

        function inIgnore(style, terminator) {
            return (source, setState) => {
                let terminated = false;
                while (!source.endOfLine()) {
                    if (source.lookAhead(terminator, true)) {
                        terminated = true;
                        setState(inText);
                        break;
                    }
                    source.next();
                }
                if (!terminated && source.endOfLine()) {
                    source.next();
                } else {
                    while (source.lookAheadRegex(/^[\ \t]/, true)) {
                    }
                    if (source.endOfLine()) {
                        source.next();
                    }
                }
                return style;
            };
        }

        return (source, startState?: any) => Tokenizer.tokenizer(source, startState || inText);
    }))();

    // The parser. The structure of this function largely follows that of
    // parseJavaScript in parsejavascript.js (there is actually a bit more
    // shared code than I'd like), but it is quite a bit simpler.
    function parseXML(source) {
        let tokens = tokenizeXML(source);
        let token;
        let cc = [base];
        let tokenNr = 0;
        let indented = 0;
        let currentTag = null;
        let context = null;
        let consume;

        function push(fs) {
            for (let i = fs.length - 1; i >= 0; i--) {
                cc.push(fs[i]);
            }
        }
        function cont(...rest) {
            push(arguments);
            consume = true;
        }
        function pass(...rest) {
            push(arguments);
            consume = false;
        }

        function markErr() {
            token.style += ' xml-error';
        }
        function expect(text) {
            return function (style, content) {
                if (content == text) { cont(); } else {
                    markErr();
                    // tslint:disable-next-line:no-arg
                    cont(arguments.callee);
                }
            };
        }

        function pushContext(tagname, startOfLine?: any) {
            const noIndent = UseKludges.doNotIndent.hasOwnProperty(tagname) || (context && context.noIndent);
            context = { prev: context, name: tagname, indent: indented, startOfLine: startOfLine, noIndent: noIndent };
        }

        function popContext() {
            context = context.prev;
        }

        function computeIndentation(baseContext) {
            return (nextChars, current) => {
                let context = baseContext;
                if (context && context.noIndent) {
                    return current;
                }
                if (alignCDATA && /<!\[CDATA\[/.test(nextChars)) {
                    return 0;
                }
                if (context && /^<\//.test(nextChars)) {
                    context = context.prev;
                }
                while (context && !context.startOfLine) {
                    context = context.prev;
                }
                if (context) {
                    return context.indent + indentUnit;
                } else {
                    return 0;
                }
            };
        }

        function base(...rest) {
            return pass(element, base);
        }

        const harmlessTokens = { 'xml-text': true, 'xml-entity': true, 'xml-comment': true, 'xml-processing': true, 'xml-doctype': true, 'php-block': true };

        function element(style, content) {
            if (content == '<') { cont(tagname, attributes, endtag(tokenNr == 1)); } else if (content == '</') { cont(closetagname, expect('>')); } else if (style == 'xml-cdata') {
                if (!context || context.name != '!cdata') {
                    pushContext('!cdata');
                }
                if (/\]\]>$/.test(content)) { popContext(); }
                cont();
            } else if (harmlessTokens.hasOwnProperty(style)) { cont(); } else { markErr(); cont(); }
        }

        function tagname(style, content) {
            if (style == 'xml-name') {
                currentTag = content.toLowerCase();
                token.style = 'xml-tagname';
                cont();
            } else {
                currentTag = null;
                pass();
            }
        }

        function closetagname(style, content) {
            if (style == 'xml-name') {
                token.style = 'xml-tagname';
                if (context && content.toLowerCase() == context.name) { popContext(); } else { markErr(); }
            }
            cont();
        }

        function endtag(startOfLine) {
            return function (style, content) {
                if (content == '/>' || (content == '>' && UseKludges.autoSelfClosers.hasOwnProperty(currentTag))) { cont(); } else if (content == '>') { pushContext(currentTag, startOfLine); cont(); } else {
                    markErr();
                    // tslint:disable-next-line:no-arg
                    cont(arguments.callee);
                }
            };
        }

        function attributes(style) {
            if (style == 'xml-name') { token.style = 'xml-attname'; cont(attribute, attributes); } else { pass(); }
        }

        function attribute(style, content) {
            if (content == '=') { cont(value); } else if (content == '>' || content == '/>') { pass(endtag); } else { pass(); }
        }

        function value(style) {
            if (style == 'xml-attribute') { cont(value); } else { pass(); }
        }

        return {
            indentation() { return indented; },

            next() {
                token = tokens.next();
                if (token.style == 'whitespace' && tokenNr == 0) {
                    indented = token.value.length;
                } else {
                    tokenNr++;
                }
                if (token.content == '\n') {
                    indented = tokenNr = 0;
                    token.indentation = computeIndentation(context);
                }

                if (token.style == 'whitespace' || token.type == 'xml-comment' || token.type == 'php-block') {
                    return token;
                }

                while (true) {
                    consume = false;
                    const t = cc.pop();
                    t(token.style, token.content);
                    if (consume) {
                        return token;
                    }
                }
            },

            copy() {
                const _cc = cc.concat([]);
                const _tokenState = tokens.state;
                const _context = context;
                // tslint:disable-next-line:no-invalid-this
                const parser = this;

                return input => {
                    cc = _cc.concat([]);
                    tokenNr = indented = 0;
                    context = _context;
                    tokens = tokenizeXML(input, _tokenState);
                    return parser;
                };
            }
        };
    }

    return {
        make: parseXML,
        electricChars: '/',
        configure(config) {
            if (config.useHTMLKludges != null) {
                //ximpl.
                // UseKludges = config.useHTMLKludges ? Kludges : NoKludges;
            }
            if (config.alignCDATA) {
                alignCDATA = config.alignCDATA;
            }
        }
    };
}))();

const parse = (text, parentElement) => {
    const txtStream = {
        next: function () {
            // tslint:disable-next-line:no-invalid-this
            if (++this.count == 1) {
                return text;
            } else {
                throw new Error('it');
            }
            // tslint:disable-next-line:align
        }, count: 0, text: text
    };
    const stream = Tokenizer.stringStream(txtStream);
    const parser = XMLParser.make(stream);
    let token;
    const errors = [];
    function error(text) { errors.push(text); }

    const stack = [];
    stack.push(parentElement);
    let htmlText;
    let inComment;
    let inPhpBlock;

    function addText(text, offset) {
        htmlText = new HTMLText();
        htmlText.wasParsed = true;
        htmlText.startOffset = offset;
        stack[stack.length - 1].addChild(htmlText, undefined, true);
        htmlText.value = text;

    }

    function addTrailingWS(token) {
        if (token.content != token.value) {
            addText(token.value.substring(token.content.length), token.offset + token.value.length);
        }
    }

    function updateFMInfo(str, element) {
        const lines = str.split('\n');
        const indent = lines[lines.length - 1].length;
        //ximpl.
        let lastElement: any;
        if (element.children.length) {
            lastElement = element.children[element.children.length - 1];
            lastElement._fmLine = lines.length - 1;
            lastElement._fmIndent = indent;
        } else {
            element._fmChildLine = lines.length - 1;
            element._fmChildIndent = indent;
        }
    }

    function updateText() {
        if (htmlText != null && !htmlText.value.match(/\S/)) {
            const lastElement = stack[stack.length - 1];
            lastElement.children.pop();	// remove the htmlText
            updateFMInfo(htmlText.value, lastElement);
        }
        htmlText = null;
    }

    function parseStyle() {
        const lastElement = stack[stack.length - 1];
        stream.nextWhileMatches(/[\s\u00a0]/);
        const str = stream.get();
        if (htmlText != null) {
            htmlText.value += str;
            updateText();
        } else {
            updateFMInfo(str, lastElement);
        }
        CSSParser['parse'](stream, lastElement);
    }

    function nextToken(ignoreWS) {
        token = parser.next();
        while (ignoreWS && token.style == 'whitespace') {
            token = parser.next();
        }
        return token;
    }

    try {
        do {
            token = parser.next();
            let model = new HTMLElement();
            switch (token.style) {
                case 'xml-punctuation': {
                    updateText();
                    if (token.content == '<') {

                        model.wasParsed = true;
                        model.startOffset = token.offset;
                        stack[stack.length - 1].addChild(model, undefined, true);
                        nextToken(true);
                        if (token.style == 'xml-tagname') {
                            model.tag = token.content;
                        } else {
                            error('expecting tag name');
                        }

                        while ((token = nextToken(true)).style == 'xml-attname') {
                            const attribute = new HTMLAttribute();
                            attribute.wasParsed = true;
                            model.attributes.push(attribute);
                            attribute.name = token.content;
                            attribute.startOffset = token.offset;
                            nextToken(true);
                            if (token.content == '=') {
                                token = parser.next();
                                if (token.style == 'xml-attribute') {
                                    const s = token.content;
                                    attribute.setValue(s.substring(1, s.length - 1));

                                } else {
                                    error('expecting attribute value');
                                }
                            } else {
                                attribute.noValue = true;
                                attribute.setValue(true);
                            }
                            attribute.endOffset = token.offset - 1;
                            if (attribute.noValue && token.style != 'xml-attname') {
                                break;
                            }
                        }
                        if (token.style != 'xml-punctuation') {
                            error('expecting >');
                        } else {
                            model.startTagOffset = token.offset;
                            if (token.content == '>') {
                                stack.push(model);
                            } else {
                                model.noEndTag = true;
                                model = stack[stack.length - 1];
                            }
                            addTrailingWS(token);
                        }
                        if (model.tag == 'style') {
                            parseStyle();
                        }

                    } else if (token.value == '</') {
                        const prevModel = model;
                        token = parser.next();
                        if (model.tag == 'script') {
                            model.script = model.getElementText();
                        }
                        stack.pop();
                        model = stack[stack.length - 1];
                        token = parser.next();
                        prevModel.endOffset = token.offset;
                        addTrailingWS(token);
                    }
                    inPhpBlock = null;
                }
                                        break;
                case 'xml-text':
                case 'whitespace':
                case 'xml-entity': {
                    if (inComment) {
                        inComment.value += token.value;
                    } else if (inPhpBlock) {
                        inPhpBlock.value += token.value;
                    } else {
                        if (!htmlText) {
                            addText(token.value, token.offset);
                        } else {
                            htmlText.value += token.value;
                        }
                    }
                    inPhpBlock = null;
                }
                                   break;
                case 'xml-comment': {
                    updateText();
                    let comment = new HTMLComment();
                    comment.wasParsed = true;
                    comment.startOffset = token.offset;
                    comment.value = token.content.substring(4, token.content.length - 3);
                    comment.endOffset = token.offset + token.content.length;
                    stack[stack.length - 1].addChild(comment, undefined, true);
                    inPhpBlock = null;
                }
                                    break;
                case 'xml-doctype': {
                    let comment = new HTMLComment();
                    if (!inComment) {
                        updateText();
                        comment.wasParsed = true;
                        comment.startOffset = token.offset;
                        comment.value = token.value.substring(2);
                        stack[stack.length - 1].addChild(comment, undefined, true);
                        comment.isProcessingInstruction = true;
                        token = parser.next();
                    }
                    const lastChar = token.content.length - 1;
                    if (token.content.charAt(token.content.length - 1) == '>') {
                        comment.endOffset = token.offset + token.content.length;
                        comment.value += token.content.substring(0, lastChar);
                        addTrailingWS(token);
                        inComment = undefined;
                    } else {
                        inComment = comment;
                        comment.value += token.content;
                    }
                    inPhpBlock = null;
                }
                                    break;
            }
        } while (true);
    } catch (e) { }

    return { errors: errors, endOffset: (token ? token.offset : 0) };
};

export const HTMLParser = {
    parse: parse
}

/*
return {
    parse: parse
};
*/
