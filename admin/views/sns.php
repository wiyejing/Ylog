 <?php
/**
 * SNS配置
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

</head>
<body>
  <form class="easyui-tabs" id="sns" fit="true" tools="#sns-tools" action="<?php echo site_url('sns/save')?>" method="post">
    <?php foreach ($oauth2 as $key => $value): ?>
      <div title="<?=$value['name']?>" style="padding: 10px;">
        <table cellpadding="5">
          <tr>
            <td>ID：</td>
            <td><input class="easyui-textbox" value="<?=$value['id']?>" type="text" name="<?=$key?>['id']" data-options="required:true"></td>
          </tr>
          <tr>
            <td>SERCET：</td>
            <td><input class="easyui-textbox" value="<?=$value['secret']?>" type="text" name="<?=$key?>['secret']" data-options="required:true"></td>
          </tr>
          <tr>
            <td>备注：</td>
            <td><input class="easyui-textbox" value="<?=$value['extra']?>" type="text" name="<?=$key?>['extra']"></td>
          </tr>
        </table>
      </div>
    <?php endforeach ?>
  </form>
  <div  id="sns-tools">
      <a href="javascript:void(0)" class="easyui-linkbutton" plain="true" iconCls='icon-add' onclick="add()">添加</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" plain="true" iconCls='icon-pagesave' onclick="save()">保存配置</a>
  </div>
  <script>
  function save() {
    $('#sns').submit();
  }
  $(function(){
      $('#sns').form({
          success:function(data){
              $.messager.alert('Info', data, 'info');
          }
      });
  });
  </script>
</body>
</html>
