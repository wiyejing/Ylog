<?php
/**
 * 回收站视图
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div style="text-align: right;padding:5px 0" id="tb">
    <span class="fl pl10" style="line-height:26px;">
      <span>ID:</span>
      <input id="id" style="width:50px;" class="easyui-textbox">
      <span class="pl10">标题</span>
      <input id="title" style="width:150px;" class="easyui-textbox">
      <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()" plain="true">搜索</a>
    </span>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="restore();">还原</a>
    <a href="javascript:;" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="delete_item(1);">彻底删除</a>
  </div>
  <table id="list" toolbar="#tb" fit="true">
  </table>
<script>
  $(function() {
    $('#list').datagrid({
      singleSelect:false,
      pagination:true,
      url: '<?php echo site_url("document/recycle_json/")?>',
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
          field: 'pid',
          title: '父栏目'
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
    $.messager.confirm('确认', "确认彻底删除ID为 "+ss.join(',')+" 的文档吗？",function(r){
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
  function restore () {
    var ss = [];
    var rows = $('#list').datagrid('getSelections');
    for(var i=0; i<rows.length; i++){
        ss.push(rows[i].id);
    }
    $.messager.confirm('确认', "确认恢复ID为 "+ss.join(',')+" 的文档吗？",function(r){
      if (r){
        $.ajax({
          url: '<?php echo site_url("document/restore")?>',
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
</script>