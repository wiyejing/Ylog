<?php
/**
 * 左边导航
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div data-options="region:'west',split:true" title="菜单" style="width:175px;">
  <div id="aa" class="easyui-accordion" style="height:100%;">
  <!-- collapsible:false, -->
    <div title="内容管理" data-options="iconCls:'icon-list',tools:[{
        iconCls: 'icon-reload',
        handler: function() {
          $('#nav_tree').tree('reload');
        }
      }]" style="overflow:auto;padding:10px;">
      <ul id="nav_tree" class="easyui-tree" url='<?php echo site_url("document/tree_json")?>'></ul>
    </div>
    <div title="系统管理" data-options="iconCls:'icon-gear'" style="overflow:auto;padding:10px 0;">
      <ul id="system_tree" class="easyui-tree" url="<?php echo site_url("menu/tree_json/1")?>"></ul>
    </div>
    <div title="高级设置" data-options="iconCls:'icon-repair'" style="overflow:auto;padding:10px;">
      <ul id="config_tree" class="easyui-tree" url="<?php echo site_url("menu/tree_json/2")?>"></ul>
    </div>
  </div>
</div>