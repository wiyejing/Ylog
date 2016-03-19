<?php
/**
 * 文件管理器视图
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>文件管理器 - <?=$copyright?> & elFinder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
    <base href="<?=base_url()?>" />
    <link rel="stylesheet" type="text/css" href="src/css/jquery-ui.css">
    <script src="src/js/jquery.min.js"></script>
    <script src="src/js/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="src/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" href="src/css/theme.css">
    <script src="src/js/elfinder.min.js"></script>
    <script src="src/js/i18n/elfinder.zh_CN.js"></script>
    <style>
      body{margin: 0;padding: 10px;}
    </style>
  </head>
  <body>
    <div id="elfinder"></div>
    <script type="text/javascript" charset="utf-8">
        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
            var match = window.location.search.match(reParam) ;

            return (match && match.length > 1) ? match[1] : '' ;
        }

        $().ready(function() {
            var funcNum = getUrlParam('CKEditorFuncNum');

            var elf = $('#elfinder').elfinder({
                url : '<?php echo site_url("filemanger/init")?>',
                height: $(window).innerHeight()-22,
                lang: 'zh_CN',
                getFileCallback : function(file) {
                    window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
                    window.close();
                },
                resizable: false
            }).elfinder('instance');
        });
    </script>
  </body>
</html>
