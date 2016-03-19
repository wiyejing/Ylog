<?php
/**
 * 修改密码
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</head>
<body>
  <form action="" method="post" id="pwd" novalidate>
    <table>
      <tr>
        <td align="right"><label for="password">原密码：</label></td>
        <td><input class="easyui-validatebox" id="password" type="password" required="true" name="password" /></td>
      </tr>
      <tr>
        <td align="right"><label for="newpassword">新密码：</label></td>
        <td><input class="easyui-validatebox" id="newpassword" type="password" required="true" name="newpassword"/></td>
      </tr>
      <tr>
        <td align="right"><label for="newpassword2">确认密码：</label></td>
        <td><input class="easyui-validatebox" id="newpassword2" type="password" required="true" name="newpassword2" validType="equals['#newpassword']"/></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type="submit" class="easyui-linkbutton" data-options="iconCls:'icon-save'" value="保存">
          <input type="reset" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" value="重置">
        </td>
      </tr>
    </table>
  </form>
  <script>
    $.extend($.fn.validatebox.defaults.rules, {
        equals: {
            validator: function(value,param){
                return value == $(param[0]).val();
            },
            message: '密码不一致'
        }
    });
    $(function(){
      $('#pwd').form({
          url:"<?php echo site_url('user/updatepwd') ?>",
          onSubmit:function(){
            return $(this).form('validate');
          },
          success:function(data){
            $.messager.alert('提示', data, 'info');
            setTimeout("window.parent.$('#updatepwd').window('close');",2000);
          }
      });
    })
  </script>
</body>
</html>
