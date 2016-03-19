<?php
/**
 * 新建文档
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</head>
<body>
  <div style="text-align: right;" id="doc_tool">
    <a href="javascript:;" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'" title="保存并继续编辑" onclick="save();">保存并继续编辑</a>
    <a href="javascript:;" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-pagesave'" title="保存后关闭" onclick="saveAndClose();">保存后关闭</a>
  </div>
  <form id="doc_form" class="easyui-tabs" data-options="tools:'#doc_tool'" fit="true">
    <div title="基本信息" style="padding:10px">
        <input type="reset" name="reset" style="display: none;" />
        <input type="hidden" value="<?=$pid?>" name="pid">
        <table class="doc_table" cellpadding="5">
          <tr>
            <td align="right" width="100">父类名称</td>
            <td><input type="text" class="easyui-textbox" value="<?=$ptitle?>" disabled></td>
          </tr>
          <tr>
            <td align="right">标题</td>
            <td><input id="title" type="text" value="<?=$title?>" class="easyui-textbox" data-options="required:true" name="title"></td>
          </tr>
          <tr>
            <td align="right" valign="top">摘要</td>
            <td>
              <input class="easyui-textbox" name="abstract" value="<?=$abstract?>" data-options="multiline:true" style="height:120px">
            </td>
          </tr>
          <tr>
            <td align="right">发布时间</td>
            <td><input type="text" class="easyui-datetimebox" value="<?=$time?>" style="width:150px"  data-options="showSeconds:false" name="time"></td>
          </tr>
          <tr>
            <td align="right">排序</td>
            <td><input type="text" class="easyui-numberspinner" value="<?=$sort?>" style="width:70px" value="100" name="sort"></td>
          </tr>
          <tr>
            <td align="right">是否通过审核</td>
            <td>
              <select class="easyui-combobox" name="check" data-options="width:50,panelHeight:50">
                <option value="Y" <?php if($check =='Y') echo 'selected'?>>是</option>
                <option value="N" <?php if($check =='N') echo 'selected'?>>否</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right">推荐</td>
            <td>
              <select class="easyui-combobox" name="recommend" data-options="width:50,panelHeight:50">
                <option value="Y" <?php if($recommend =='Y') echo 'selected'?>>是</option>
                <option value="N" <?php if($recommend =='N') echo 'selected'?>>否</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right">菜单开关</td>
            <td>
              <select class="easyui-combobox" name="state" data-options="width:60,panelHeight:50">
                <option value="Y" <?php if($state =='Y') echo 'selected'?>>显示</option>
                <option value="N" <?php if($state =='N') echo 'selected'?>>关闭</option>
              </select>
            </td>
          </tr>
        </table>
    </div>
    <div title="详细信息" style="padding:10px" iconCls="icon-info">
      <textarea name="content" id="content" style="width:100%;height:500px" ><?=$content?></textarea>
    </div>
    <div title="文件与图片" style="padding:10px">
      <table class="doc_table" cellpadding="5">
          <tr>
            <td align="right" width="100">logo或缩略图</td>
            <td><input type="text" id="logo"  value="<?=$logo?>" name="logo"><a id="uploadlogo" href="javascript:;" class="easyui-linkbutton pl10" iconCls="icon-file" plain="true">上传</a></td>
          </tr>
          <tr>
            <td align="right">大图</td>
            <td><input type="text" id="picture" value="<?=$picture?>" name="picture"><a href="javascript:;" id="uploadpicture" class="easyui-linkbutton pl10" iconCls="icon-file" plain="true">上传</a></td>
          </tr>
          <tr>
            <td align="right">附件</td>
            <td><input type="text" id="file" value="<?=$file?>" name="file"><a href="javascript:;" id="uploadfile" class="easyui-linkbutton pl10" iconCls="icon-file" plain="true">上传</a></td>
          </tr>
          <tr>
            <td align="right">外链url</td>
            <td><input type="url" class="easyui-textbox" value="<?=$link?>" name="link"></td>
          </tr>
        </table>
    </div>
    <div title="SEO设置" style="padding:10px">
      <table class="doc_table" cellpadding="5">
        <tr>
          <td align="right" width="100">SEO关键字</td>
          <td><input type="text" class="easyui-textbox" name="keywords" value="<?=$keywords?>"></td>
        </tr>
        <tr>
          <td align="right" valign="top">SEO描述</td>
          <td>
            <input class="easyui-textbox" name="description" data-options="multiline:true" style="height:80px" value="<?=$description?>">
          </td>
        </tr>
        <tr>
          <td align="right">SEO网页标题</td>
          <td><input type="text" class="easyui-textbox" name="meta_title" value="<?=$meta_title?>"></td>
        </tr>
      </table>
    </div>
  </form>
<script charset="utf-8" src="kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script>
  KindEditor.options.filterMode = false;
  KindEditor.ready(function(K) {
    window.editor = K.create('#content',{
      uploadJson : 'upload_json.php',
      fileManagerJson : 'file_manager_json.php',
      allowFileManager : true,
    });
    K('#uploadlogo').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          imageUrl : K('#logo').val(),
          clickFn : function(url, title, width, height, border, align) {
            K('#logo').val(url);
            editor.hideDialog();
          }
        });
      });
    });
    K('#uploadpicture').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          imageUrl : K('#picture').val(),
          clickFn : function(url, title, width, height, border, align) {
            K('#picture').val(url);
            editor.hideDialog();
          }
        });
      });
    });
    K('#uploadfile').click(function() {
      editor.loadPlugin('insertfile', function() {
        editor.plugin.fileDialog({
          fileUrl : K('#file').val(),
          clickFn : function(url, title) {
            K('#file').val(url);
            editor.hideDialog();
          }
        });
      });
    });
  });

  function saveAndClose () {
    if(save())
    {
      setTimeout("window.parent.updateTab(1);window.parent.$('#tabs').tabs('close', '编辑文档(ID:<?=$id?>)')",1000);
    }
  }
  function save () {
    var title = $("#title").val();
    editor.sync();
    if(title)
    {
      $.ajax({
        url: '<?php echo site_url("document/save/".$id)?>',
        type: 'POST',
        data: $("#doc_form").serialize()
      })
      .done(function() {
        console.log("save success");
        $.messager.show({
          title:'提示',
          msg:'该文档已成功保存',
          timeout:3000,
          showType:'slide'
        });
        // window.parent.updateTab(1);
      })
      .fail(function() {
        // console.log("error");
      })
      .always(function() {
        // console.log("complete save");
      });
      return true;
    }
    else
    {
      $("#doc_form").tabs('select', 0);
      $("#title").next().find('input[type="text"]').focus();
      $.messager.show({
        title:'提示',
        msg:'保存文档前，请填写标题！',
        timeout:3000,
        showType:'slide'
      });
      return false;
    }
  }
</script>
</body>
</html>
