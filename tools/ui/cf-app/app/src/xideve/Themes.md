1. The apply to 'theme' happens in davinci.ve.widgets.Cascade

**Loading Themes***



1. xideve/delite/_ContextTheme::getTheme()
    metaData.loadThemeMeta(this._srcDocument):
        metaData.loadThemeMeta(this._srcDocument)
            var allThemes = Library.getThemes(Workbench.getProject());
                davinci/library::getThemes(base=project1)
                    xhr:xapp/xide/cmd/getThemes?path=*.theme&ignoreCase=true&workspaceOnly=false&inFolder=project1%2Fthemes

```json
        xhr:xapp/xide/cmd/getThemes:
        [
            {
                "specVersion": "1.0",
                "files": ["blackberry.css"],
                "useBodyFontBackgroundClass": "useBodyFontBg",
                "helper": "maq-metadata-dojo/dojox/mobile/ThemeHelper",
                "themeEditorHtmls": ["../custom/dojo-theme-editor.html"],
                "name": "blackberry",
                "path": ["project1/themes/blackberry/blackberry.theme"],
                "base": "",
                "className": "blackberry",
                "type": "dojox.mobile",
                "meta": ["../custom/custom.json"],
                "version": "1.8"
            },
            {
                "specVersion": "1.0",
                "files": ["claro.css"],
                "helper": "maq-metadata-dojo/dijit/ThemeHelper",
                "themeEditorHtmls": ["dojo-theme-editor.html"],
                "name": "claro",
                "path": ["project1/themes/claro/claro.theme"],
                "conditionalFiles": ["document.css"],
                "className": "claro",
                "meta": ["claro.json"],
                "version": "1.8"
            },
            {
                "specVersion": "1.0",
                "files": ["ipad.css"],
                "useBodyFontBackgroundClass": "useBodyFontBg",
                "helper": "maq-metadata-dojo/dojox/mobile/ThemeHelper",
                "themeEditorHtmls": ["dojo-theme-editor.html"],
                "name": "ipad",
                "path": ["project1/themes/ipad/ipad.theme"],
                "base": "",
                "className": "ipad",
                "type": "dojox.mobile",
                "meta": ["ipad.json"],
                "version": "1.8"
            },
            {
                "specVersion": "1.0",
                "files": ["android.css"],
                "useBodyFontBackgroundClass": "useBodyFontBg",
                "helper": "maq-metadata-dojo/dojox/mobile/ThemeHelper",
                "themeEditorHtmls": ["../custom/dojo-theme-editor.html"],
                "name": "android",
                "path": ["project1/themes/android/android.theme"],
                "base": "",
                "className": "android",
                "type": "dojox.mobile",
                "meta": ["../custom/custom.json"],
                "version": "1.8"
            },
            {
                "specVersion": "1.0",
                "files": ["custom.css"],
                "useBodyFontBackgroundClass": "useBodyFontBg",
                "helper": "maq-metadata-dojo/dojox/mobile/ThemeHelper",
                "themeEditorHtmls": ["dojo-theme-editor.html"],
                "name": "custom",
                "path": ["project1/themes/custom/custom.theme"],
                "base": "",
                "className": "custom",
                "type": "dojox.mobile",
                "meta": ["custom.json"],
                "version": "1.8"
            },
            {
                "specVersion": "1.0",
                "files": ["iphone.css"],
                "useBodyFontBackgroundClass": "useBodyFontBg",
                "helper": "maq-metadata-dojo/dojox/mobile/ThemeHelper",
                "themeEditorHtmls": ["../custom/dojo-theme-editor.html"],
                "name": "iphone",
                "path": ["project1/themes/iphone/iphone.theme"],
                "base": "",
                "className": "iphone",
                "type": "dojox.mobile",
                "meta": ["../custom/custom.json"],
                "version": "1.8"
            },
            {
                "specVersion": "1.0",
                "files": ["sketch.css"],
                "themeEditorHtmls": ["../claro/dojo-theme-editor.html"],
                "name": "Sketch",
                "path": ["project1/themes/sketch/sketch.theme"],
                "className": "claro",
                "meta": ["../claro/claro.json"],
                "version": "1.8"
            }
        ]
```