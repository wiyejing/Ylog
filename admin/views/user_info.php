<?php
/**
 * 修改用户信息
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
*/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</head>
<body>

  <div id="tab-tools">
    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onclick="javascript:$('#p').panel('open')">保存并继续编辑</a>
    <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-save" onclick="javascript:$('#p').panel('close')">保存后关闭</a>
  </div>
  <div id="info" class="easyui-tabs" title="个人信息" style="width:100%;height:100%;" data-options="tools:'#tab-tools'">
    <div title="修改个人信息" style="padding:10px">

    </div>
  </div>
</body>
</html>
