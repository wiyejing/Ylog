<?php
/**
 * 文章列表
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</head>
<body>
  <div style="text-align: right;" id="tb">
    <span class="fl pl10" style="line-height:38px;">
      <span>ID:</span>
      <input id="id" style="width:50px;" class="easyui-textbox">
      <span class="pl10">标题</span>
      <input id="title" style="width:150px;" class="easyui-textbox">
      <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()" plain="true">搜索</a>
    </span>
    <span class="pr10"  style="line-height:38px;">当前栏目：<strong><?=$title?>(ID:<?=$pid?>)</strong></span>
    <a href="javascript:;" onclick="window.parent.addTab('新增文档(PID:<?=$pid?>)','<?php echo site_url("document/create/".$pid)?>',1)" class="easyui-linkbutton" iconCls="icon-add" plain="true">新增</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit();">编辑</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-save" plain="true">保存排序</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-cut" plain="true">资料转移</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="delete_item();">删除</a>
    <a href="javascript:;" class="easyui-menubutton" data-options="menu:'#mm1'">更多操作</a>
    <div id="mm1">
      <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-copy" plain="true" onclick="copy();">复制</a>
      <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-ok" plain="true">通过审核</a>
      <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-redo" plain="true">取消审核</a>
      <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="delete_item(1);">彻底删除</a>
    </div>
  </div>
  <table id="list" toolbar="#tb" fit="true">
  </table>
  <script>
  $(function() {
    $('#list').datagrid({
      singleSelect:false,
      pagination:true,
      url: '<?php echo site_url("document/grid_json/".$pid)?>',
      columns: [
        [{
          field:'',
          checkbox:true
        },{
          field: 'id',
          title: 'ID',
          align: 'center'
        }, {
          field: 'title',
          title: '标题',
          width: 240
        }, {
          field: 'abstract',
          title: '摘要',
          width: 160
        }, {
          field: 'sort',
          title: '排序',
          align: 'center'
        }, {
          field: 'check',
          title: '审核',
          align: 'center'
        }, {
          field: 'recommend',
          title: '推荐',
          width: 50,
          align: 'center'
        },{
          field: 'create_time',
          title: '创建时间',
          width: 130,
        },{
          field: 'uid',
          title: '创建人'
        }]
      ]
    });
    //设置分页控件 
    var p = $('#list').datagrid('getPager'); 
    $(p).pagination({ 
        pageSize: 10,//每页显示的记录条数，默认为10 
        pageList: [10,20,50,100],//可以设置每页记录条数的列表 
        beforePageText: '第',//页数文本框前显示的汉字 
        afterPageText: '页 共 {pages} 页', 
        displayMsg: '当前显示 {from} - {to} 条记录，共 {total} 条记录', 
    });  
  });
  //删除
  function delete_item(bool){
    var ss = [];
    var rows = $('#list').datagrid('getSelections');
    for(var i=0; i<rows.length; i++){
        ss.push(rows[i].id);
    }
    var url = bool ? '<?php echo site_url("document/del/1")?>' : '<?php echo site_url("document/del")?>';
    $.messager.confirm('确认', "确认删除ID为 "+ss.join(',')+" 的文档吗？",function(r){
      if (r){
        $.ajax({
          url: url,
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