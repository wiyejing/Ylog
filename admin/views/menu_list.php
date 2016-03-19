<?php
/**
 * 菜单管理视图
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</head>
<body>
  <div style="text-align: right;padding: 5px 0;" id="tb">
    <a href="javascript:;" onclick="window.parent.addTab('新增菜单','<?php echo site_url("menu/create")?>',1)" class="easyui-linkbutton" iconCls="icon-add" plain="true">新增</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit();">编辑</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-save" plain="true">保存排序</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="delete_item();">删除</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-ok" plain="true">显示</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-redo" plain="true">隐藏</a>
  </div>
  <table id="list" toolbar="#tb" class="easyui-treegrid" data-options="
        url: '<?php echo site_url("menu/grid_json")?>',
        idField: 'mid',
        treeField: 'title'
      ">
    <thead>
      <th field="" checkbox="true"></th>
      <th field="mid">ID</th>
      <th field="title">标题</th>
      <th field="pid">上级菜单</th>
      <th field="sort">排序</th>
      <th field="url">链接</th>
      <th field="display" align="center">显示</th>
      <th field="create_time">创建时间</th>
      <th field="level" align="center">级别</th>
    </thead>
  </table>
  <script>

/*  $(function() {
    $('#list').datagrid({
      singleSelect:false,
      pagination:true,
      url: '<?php echo site_url("menu/grid_json")?>',
      pageSize:'50',
      columns: [
        [{
          field:'',
          checkbox:true
        },{
          field: 'mid',
          title: 'ID',
          align: 'center'
        }, {
          field: 'title',
          title: '标题',
        }, {
          field: 'pid',
          title: '上级菜单',
        }, {
          field: 'sort',
          title: '排序',
          align: 'center'
        }, {
          field: 'url',
          title: '链接',
        }, {
          field: 'display',
          title: '显示',
          align: 'center'
        }, {
          field: 'create_time',
          title: '创建时间',
          align: 'center'
        }, {
          field: 'level',
          title: '级别',
        }]
      ]
    });
  });*/
  //删除
  function delete_item(){
    var ss = [];
    var rows = $('#list').datagrid('getSelections');
    for(var i=0; i<rows.length; i++){
        ss.push(rows[i].id);
    }
    $.messager.confirm('确认', "确认删除ID为 "+ss.join(',')+" 的文档吗？",function(r){
      if (r){
        $.ajax({
          url: '<?php echo site_url("document/del")?>',
          type: 'POST',
          data: {'id':ss}
        })
        .done(function() {
          console.log("success");
          $('#list').datagrid('load');
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
      }
    });
    
  }
  // 搜索
  function doSearch(){
    $('#list').datagrid('load',{
      id: $('#id').val(),
      title: $('#title').val()
    });
  }  
  function edit () {
    var row = $('#list').datagrid('getSelected');
    if (row){
      window.parent.addTab('编辑文档(ID:'+row.id+')','<?php echo site_url("document/edit")?>/'+row.id,1);
    }
  }
  function copy(){
    var row = $('#list').datagrid('getSelected');
    if (row){
      $.ajax({
        url: '<?php echo site_url("document/copy")?>/'+row.id,
        type: 'GET'
      })
      .done(function() {
        console.log("success");
        $('#list').datagrid('load');
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    }
  }
  </script>
</body>
</html>