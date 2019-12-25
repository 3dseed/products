<?php

$_REQUEST_URI = $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
putenv("REQUEST_URI=$_REQUEST_URI");
$_SERVER["REQUEST_URI"] = $_REQUEST_URI;
$_ENV["REQUEST_URI"] = $_REQUEST_URI;

$XAPP_BASE_DIRECTORY =  realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');
/***
 * Framework minimal includes, ignore!
 */
define('XAPP_BASEDIR',$XAPP_BASE_DIRECTORY); //important !
require_once(XAPP_BASEDIR . '/XApp_Service_Entry_Utils.php');
XApp_Service_Entry_Utils::includeXAppCore();
/*error_log(XApp_Service_Entry_Utils::getUrl());*/
header('Content-Type: application/json');

$url = XApp_Service_Entry_Utils::getUrl();
/*error_log('find resource path : '  . $url );*/
if(strpos($url,'path=project1%2Fthemes%2Fdijit%2Fthemes%2Fclaro%2Fdocument.css&ignoreCase=true')!==false){
    echo '[{"file" : "project1/themes/dijit/themes/claro/document.css", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : true, "isDirty" : false}]}, {"name" : "project1", "members" : [{"isDir" : false, "name" : "app.js", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "lib", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "iphone.html", "readOnly" : true, "isDirty" : true}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "dijit", "members" : [{"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "icons", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "claro", "members" : [{"isDir" : true, "name" : "layout", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "form", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "document.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro_rtl.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "images", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]';
    exit;
}
if(strpos($url,'path=project1%2Fthemes%2Fdijit%2Fthemes%2Fclaro%2Fclaro.css&ignoreCase=true')!==false){
    echo '[{"file" : "project1/themes/dijit/themes/claro/claro.css", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : true, "isDirty" : false}]}, {"name" : "project1", "members" : [{"isDir" : false, "name" : "app.js", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "lib", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "iphone.html", "readOnly" : true, "isDirty" : true}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "dijit", "members" : [{"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "icons", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "claro", "members" : [{"isDir" : true, "name" : "layout", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "form", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "document.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro_rtl.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "images", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]';
    exit;
}
if(strpos($url,'path=project1%2Fthemes%2Fclaro%2Fdocument.css&ignoreCase=true')!==false){
    echo '[{"file" : "project1/themes/claro/document.css", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : true, "isDirty" : false}]}, {"name" : "project1", "members" : [{"isDir" : false, "name" : "app.js", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "lib", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "iphone.html", "readOnly" : true, "isDirty" : true}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "claro", "members" : [{"isDir" : false, "name" : "claro.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "dojo-theme-editor.html", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "document.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.json", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.theme", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]';
    exit;
}
if(strpos($url,'path=*_widgets.json&ignoreCase=true&inFolder=.%2Fproject1%2Flib%2Fcustom')!==false){
    echo('[]');
    exit;
}
if(strpos($url,'path=project1&ignoreCase=true')!==false){

    echo ('[{"file" : "./project1", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : true, "isDirty" : false}]}]}]');
    exit;
}
if(strpos($url,'project1%2Fthemes%2Fiphone%2Fiphone.css&ignoreCase=true')!==false){
    echo ('[{"file" : "project1/themes/dojox/mobile/themes/iphone/iphone.css", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : true, "isDirty" : false}]}, {"name" : "project1", "members" : [{"isDir" : false, "name" : "app.js", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "lib", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "iphone.html", "readOnly" : true, "isDirty" : true}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "dojox", "members" : [{"isDir" : true, "name" : "mobile", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "mobile", "members" : [{"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "common", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "iphone", "members" : [{"isDir" : false, "name" : "iphone-app-compat.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "ipad-compat.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "iphone-app.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "iphone-compat.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "ipad.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "images", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "iphone.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "compat", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]');
    exit;
}
if(strpos($url,'path=project1%2Fthemes%2Fclaro%2Fclaro.theme&ignoreCase=true')!==false){
    echo ('[{"file" : "project1/themes/claro/claro.theme", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "testProject", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "asdasdasd", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "zxc", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "123asd", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "345345", "readOnly" : false, "isDirty" : false}]}, {"name" : "345345", "members" : [{"isDir" : true, "name" : "lib", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "app.js", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "sd3.html", "readOnly" : false, "isDirty" : true}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "claro", "members" : [{"isDir" : false, "name" : "claro.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "dojo-theme-editor.html", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "document.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.json", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.theme", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]');
    exit;
}
echo('[]');
//findResource.php?path=project1%2Flib%2Fcustom&ignoreCase=true
//findResource.php?path=project1%2Fthemes%2Fclaro%2Fclaro.theme&ignoreCase=true
//[{"file" : "project1/themes/claro/claro.theme", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "testProject", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "asdasdasd", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "zxc", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "123asd", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "345345", "readOnly" : false, "isDirty" : false}]}, {"name" : "345345", "members" : [{"isDir" : true, "name" : "lib", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "app.js", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "sd3.html", "readOnly" : false, "isDirty" : true}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "claro", "members" : [{"isDir" : false, "name" : "claro.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "dojo-theme-editor.html", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "document.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.json", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.theme", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]

/*
if(strpos($url,'project1%2Fthemes%2Fclaro%2Fclaro.theme&ignoreCase=true')!==false){
    echo ('[{"file" : "project1/themes/dojox/mobile/themes/iphone/iphone.css", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : true, "isDirty" : false}]}, {"name" : "project1", "members" : [{"isDir" : false, "name" : "app.js", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "lib", "readOnly" : true, "isDirty" : false}, {"isDir" : false, "name" : "iphone.html", "readOnly" : true, "isDirty" : true}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "dojox", "members" : [{"isDir" : true, "name" : "mobile", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "mobile", "members" : [{"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "common", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "iphone", "members" : [{"isDir" : false, "name" : "iphone-app-compat.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "ipad-compat.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "iphone-app.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "iphone-compat.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "ipad.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "images", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "iphone.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "compat", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]');
    exit;
}
*/
//http://192.168.1.37:81/x4mm/Code/trunk/xide-php/maqetta/cmd/findResource.php?path=project1%2Fthemes%2Fclaro%2Fclaro.theme&ignoreCase=true
//project1%2Fthemes%2Fclaro%2Fclaro.theme&ignoreCase=true
//[{"file" : "345345/themes/claro/claro.theme", "parents" : [{"name" : "", "members" : [{"isDir" : true, "name" : "project1", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "testProject", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "asdasdasd", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "zxc", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "123asd", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "345345", "readOnly" : false, "isDirty" : false}]}, {"name" : "345345", "members" : [{"isDir" : false, "name" : "sd2.html", "readOnly" : false, "isDirty" : true}, {"isDir" : true, "name" : "lib", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "app.js", "readOnly" : false, "isDirty" : false}, {"isDir" : false, "name" : "app.css", "readOnly" : false, "isDirty" : false}, {"isDir" : true, "name" : "themes", "readOnly" : true, "isDirty" : false}, {"isDir" : true, "name" : "samples", "readOnly" : true, "isDirty" : false}]}, {"name" : "themes", "members" : [{"isDir" : true, "name" : "blackberry", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "claro", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "ipad", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "android", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "custom", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "iphone", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dojox", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "dijit", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : true, "name" : "sketch", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}, {"name" : "claro", "members" : [{"isDir" : false, "name" : "claro.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "dojo-theme-editor.html", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "document.css", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.json", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}, {"isDir" : false, "name" : "claro.theme", "readOnly" : true, "isDirty" : false, "libraryId" : "DojoThemes", "libVersion" : "1.8"}]}]}]


//http://www.mc007ibi.dyndns.org:8081/maqetta/cmd/getThemes?path=*.theme&ignoreCase=true&workspaceOnly=false&inFolder=345345%2Fthemes
//[ {"specVersion":"1.0","files":["blackberry.css"],"useBodyFontBackgroundClass":"useBodyFontBg","helper":"maq-metadata-dojo/dojox/mobile/ThemeHelper","themeEditorHtmls":["../custom/dojo-theme-editor.html"],"name":"blackberry","path":["345345/themes/blackberry/blackberry.theme"],"base":"","className":"blackberry","type":"dojox.mobile","meta":["../custom/custom.json"],"version":"1.8"}, {"specVersion":"1.0","files":["claro.css"],"helper":"maq-metadata-dojo/dijit/ThemeHelper","themeEditorHtmls":["dojo-theme-editor.html"],"name":"claro","path":["345345/themes/claro/claro.theme"],"conditionalFiles":["document.css"],"className":"claro","meta":["claro.json"],"version":"1.8"}, {"specVersion":"1.0","files":["ipad.css"],"useBodyFontBackgroundClass":"useBodyFontBg","helper":"maq-metadata-dojo/dojox/mobile/ThemeHelper","themeEditorHtmls":["dojo-theme-editor.html"],"name":"ipad","path":["345345/themes/ipad/ipad.theme"],"base":"","className":"ipad","type":"dojox.mobile","meta":["ipad.json"],"version":"1.8"}, {"specVersion":"1.0","files":["android.css"],"useBodyFontBackgroundClass":"useBodyFontBg","helper":"maq-metadata-dojo/dojox/mobile/ThemeHelper","themeEditorHtmls":["../custom/dojo-theme-editor.html"],"name":"android","path":["345345/themes/android/android.theme"],"base":"","className":"android","type":"dojox.mobile","meta":["../custom/custom.json"],"version":"1.8"}, {"specVersion":"1.0","files":["custom.css"],"useBodyFontBackgroundClass":"useBodyFontBg","helper":"maq-metadata-dojo/dojox/mobile/ThemeHelper","themeEditorHtmls":["dojo-theme-editor.html"],"name":"custom","path":["345345/themes/custom/custom.theme"],"base":"","className":"custom","type":"dojox.mobile","meta":["custom.json"],"version":"1.8"}, {"specVersion":"1.0","files":["iphone.css"],"useBodyFontBackgroundClass":"useBodyFontBg","helper":"maq-metadata-dojo/dojox/mobile/ThemeHelper","themeEditorHtmls":["../custom/dojo-theme-editor.html"],"name":"iphone","path":["345345/themes/iphone/iphone.theme"],"base":"","className":"iphone","type":"dojox.mobile","meta":["../custom/custom.json"],"version":"1.8"}, {"specVersion":"1.0","files":["sketch.css"],"themeEditorHtmls":["../claro/dojo-theme-editor.html"],"name":"Sketch","path":["345345/themes/sketch/sketch.theme"],"className":"claro","meta":["../claro/claro.json"],"version":"1.8"}]
/*
xide-php/maqetta/cmd/findResource.php?path=project1&ignoreCase=true, 
xide-php/maqetta/cmd/findResource.php?path=project1&ignoreCase=true&inFolder=., 
xide-php/maqetta/cmd/findResource.php?path=project1&ignoreCase=true, 
xide/code/php/xide-php/maqetta/cmd/findResource.php?path=project1%2Fsamples&ignoreCase=true, 
xide/code/php/xide-php/maqetta/cmd/findResource.php?path=project1%2Fthemes&ignoreCase=true, 
xide/code/php/xide-php/maqetta/cmd/findResource.php?path=project1%2Flib%2Fcustom&ignoreCase=true, 
*/