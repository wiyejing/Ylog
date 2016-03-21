<?php
/**
 * 后台头部
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div data-options="region:'north'" style="height:50px">
  <div class="easyui-panel" style="padding:10px;text-align: right" border="none">
    <span class="fl" style="line-height: 24px;font-size: 16px"><b>网站后台管理系统</b></span>

    <span style="line-height: 24px;padding-right: 20px">欢迎 <?php echo $cname; ?>!</span>
    <a href="/" class="easyui-linkbutton" data-options="plain:true">网站前台</a>

    <select class="easyui-combobox" name="language" data-options="width:70,panelHeight:50,onChange:function(new_v,old_v){try{setLanguage(new_v);}catch(e){}}">
      <option value="zh" selected="selected">中文版</option>
      <option value="en">英文版</option>
    </select>

    <a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-man'">个人中心</a>
    <a href="#" class="easyui-menubutton" data-options="menu:'#mm2'">关于 Ylog</a>
  </div>

  <div id="mm1" style="width:100px;">
      <div onclick="userinofo();">个人信息</div>
      <div data-options="iconCls:'icon-key'" onclick="updatepwd();">修改密码</div>
      <div data-options="iconCls:'icon-logout'" onclick='location="<?php echo site_url('login/do_logout') ?>"'>登出</div>
  </div>

  <div id="mm2" class="menu-content" style="background:#f0f0f0;padding:10px;text-align:center;font-size:12px;color:#444;width: 200px;">
      <p>
        Ylog <?php echo YLOG_VERSION;?><br>
        Copyright &copy; 2015-<?php echo date("Y",time());?><br>
        UI基于 <a href="http://www.jeasyui.com" target="_blank">jquery-easyui</a> <i>V1.4.4</i><br>
        框架基于 <a href="https://codeigniter.com/" target="_blank">CodeIgniter</a> <i>V<?php echo CI_VERSION;?></i><br>
        编辑器采用 <a href="http://kindeditor.net/" target="_blank">kindeditor</a><i>V4.1.10</i>
      </p>
  </div>
</div>
<div id="updatepwd" style="padding:20px;line-height:35px;"></div>
<div id="userinofo"></div>
<script>
function userinofo(){
  $('#userinofo').window({
    title:'个人信息',
    width:600,
    height:400,
    modal:true,
    minimizable:false,
    maximizable:false,
    collapsible:false
  });
  $('#userinofo').window('refresh', "<?php echo site_url('user/info') ?>");
}
function updatepwd () {
    $('#updatepwd').window({
      title:'修改密码',
      width:600,
      height:300,
      modal:true,
      minimizable:false,
      maximizable:false,
      collapsible:false
    });
    $('#updatepwd').window('refresh', "<?php echo site_url('user/updatepwd') ?>");
}
</script>
