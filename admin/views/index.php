<?php
/**
 * 后台首页
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <script type="text/javascript" src="src/js/admin.js"></script>
</head>
<body>
  <div class="easyui-layout" fit="true" id="parentbody">
    <?php include "include/header.php" ?>
    <?php include "include/left.php" ?>
    <div data-options="region:'center',split:true" border="false">
      <div id="tabs" class="easyui-tabs" fit="true" tools="#tabs-tools">
        <div title="系统信息" iconCls="icon-home" style="padding:4px;">
          <div class="easyui-panel" title="站点信息" style="padding: 20px;line-height: 20px;margin-bottom: 10px;" data-options="collapsible:true,closable:true">
            <table width="100%">
              <tbody>
                <tr>
                  <td width="15%" align="right">站点统计：</td>
                  <td>
                    文章 <?=$docsum?> 篇，栏目 <?=$catsum?> 个，链接 <?=$linksum?>个</td>
                </tr>
                <tr>
                  <td align="right">网站域名：</td>
                  <td>
                    <?php echo $_SERVER['HTTP_HOST']; ?></td>
                </tr>
                <tr>
                  <td align="right">服务器操作系统：</td>
                  <td>
                    <?php echo $server;?></td>
                </tr>
                <tr>
                  <td align="right">运行环境：</td>
                  <td>
                    <?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
                </tr>
                <tr>
                  <td align="right">数据库版本：</td>
                  <td>
                    Mysql
                    <?php echo $db_version;?></td>
                </tr>
                <tr>
                  <td align="right">数据库表前缀：</td>
                  <td>
                    <?php echo $db_prefix;?></td>
                </tr>
                <tr>
                  <td align="right">网站根目录：</td>
                  <td>
                    <?php echo $_SERVER['DOCUMENT_ROOT'];?></td>
                </tr>
                <tr>
                  <td align="right">磁盘空间：</td>
                  <td>可用<?php echo file_size_count(@disk_free_space(".")),"/",file_size_count(@disk_total_space(".")) ?> (虚拟主机请以主机商提供的数据为准)</td>
                </tr>
                <tr>
                  <td align="right">上传限制：</td>
                  <td>
                    <?php echo $upload_size;?></td>
                </tr>
                <tr>
                  <td align="right">用户环境：</td>
                  <td>
                    <?php echo $platform,' , ', $agent;?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="easyui-panel" title="版权信息" style="padding: 20px;line-height: 20px;" data-options="collapsible:true,closable:true">
            <table width="100%">
              <tr>
                <td width="15%" align="right">Ylog版本：</td>
                <td>
                  <?php echo YLOG_VERSION;?>，基于 CodeIgniter V<?php echo CI_VERSION;?></td>
              </tr>
              <tr>
                <td align="right">作者：</td>
                <td>Jim Yeah (yejing@live.cn)</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div id="tabs-tools">
        <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="updateTab();">刷新</a>
      </div>
    </div>
    <?php include "include/footer.php" ?>
  </div>
</body>
</html>
