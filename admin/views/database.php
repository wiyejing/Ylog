<?php
/**
 * 数据库管理
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</head>
<body>
  <div style="text-align: right;" id="tb">
    <a href="<?php echo site_url('database/bak/local');?>" class="easyui-linkbutton" iconCls="icon-dbfile" plain="true">备份到本地</a>
    <a href="<?php echo site_url('database/bak');?>" class="easyui-linkbutton" iconCls="icon-dbadd" plain="true" onclick="edit();">备份到服务器</a>
    <a href="javascript:;" class="easyui-linkbutton optimize" iconCls="icon-dbgear" plain="true">优化数据表</a>
    <a href="javascript:;" class="easyui-linkbutton del" iconCls="icon-dbdel" plain="true">批量删除备份文件</a>
  </div>
  <table id="list" toolbar="#tb" fit="true">
    <thead>
      <tr>
        <th data-options="field:'',checkbox:true"></th>
        <th data-options="field:'filename'">备份文件</th>
        <th data-options="field:'time'">备份时间</th>
        <th data-options="field:'filesize'">文件大小</th>
        <th data-options="field:'action'">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($files as $file): ?>
        <tr>
          <td><input type="checkbox" class="ids" value="<?=$file['name']?>" name="file[]"></td>
          <td><?=$file['name']?></td>
          <td><?=date('Y-m-d H:i:s',$file['date'])?></td>
          <td><?=file_size_count($file['size'])?></td>
          <td>
          <?php echo anchor('database/del/'.$file['name'],'删除');?> 
          <?php echo anchor('database/recovery/'.$file['name'],'导入');?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <script>
    $(function(){
      $('#list').datagrid();
      $(".optimize").click(function() {
        $.ajax({
          url: "<?php echo site_url('database/optimize');?>",
        })
        .done(function(data) {
          $.messager.show({
              title:'提示',
              msg:data,
              timeout:2000,
              showType:'slide'
          });
        })
        .fail(function(data) {
          console.log("ajax optimize error");
        })
        .always(function() {
          console.log("ajax optimize complete");
        });
      });
      $(".del").click(function() {
        var ss = [];
        var msg = '';
        var rows = $('#list').datagrid('getSelections');
        for(var i=0; i<rows.length; i++){
            ss.push(rows[i].filename);
        }
        $.ajax({
          url: "<?php echo site_url('database/del');?>",
          type: 'POST',
          data: {'file':ss}
        })
        .done(function(data) {
          $.messager.show({
              title:'提示',
              msg:data,
              timeout:2000,
              showType:'slide'
          });
        })
        .fail(function() {
          console.log("ajax delete error");
        })
        .always(function() {
          console.log("ajax delete complete");
        });
      });
    })
  </script>