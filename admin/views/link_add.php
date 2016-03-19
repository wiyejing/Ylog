<?php
/**
 * 友情链接
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content link">
  <?php echo form_open('link/add/'.$id,'class="form-horizontal" name="link"'); ?>
    <fieldset>
      <legend>添加链接</legend>

      <div class="control-group">
        <label class="control-label" for="text">链接名称：</label>
        <div class="controls">
          <input type="text" id="text" class="input-xlarge" name="text" value="<?php echo isset($text) ? $text :set_value('text'); ?>">
          <span class="help-inline"><small>*</small><?php echo form_error('text'); ?></span>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="url">链接地址：</label>
        <div class="controls">
          <input type="text" id="url" class="input-xlarge" name="url" value="<?php echo isset($url) ? $url :set_value('url'); ?>">
          <span class="help-inline"><small>*</small><?php echo form_error('url'); ?></span>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="description">链接描述：</label>
        <div class="controls">
          <textarea id="description" name="description" rows="4" style="width: 270px"><?php echo isset($description) ? $description : ''; ?></textarea>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">链接类型：</label>
        <div class="controls">
          <label class="radio inline"><input type="radio" class="word" <?php echo isset($type) && $type==1 ? 'checked':'';?> value="1" name="type">文字型</label>
          <label class="radio inline"><input type="radio" class="image" <?php echo isset($type) && $type==1 ? '' : 'checked';?> value="2" name="type">图片型</label>
        </div>
      </div>

      <div class="control-group imagebox">
        <label class="control-label" for="image">链接图片：</label>
        <div class="controls">
          <input type="text" class="input-xxlarge" id="image" name="image" value="<?php echo !empty($image) ? $image : '';?>">
          <a class="btn" data-toggle="modal" id="insertfile" href="#modal"  >选择文件</a>
          <span class="help-inline">
          <?php echo isset($error) ? $error : '' ?>
          </span>
        </div>
      </div>

      <div class="form-actions">
        <input type="submit" class="btn btn-primary" value="保存">
        <input type="reset" class="btn" value="重置">
      </div>
    </fieldset>
  <?php echo form_close(); ?>
</div>
<div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <?php echo form_open_multipart('link/uploadimg','class="form-horizontal" id="upload"'); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="ModalLabel">上传图片</h3>
  </div>
  <div class="modal-body">
    <div class="control-group">
      <label class="control-label" >图片：</label>
      <div class="controls">
        <input type="file" name="linkimg" size="20" value="" />
        <span class="help-block"><small>(图片大小不能超过 1024KB，格式可为 gif、jpg或png)</small></span>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" type="submit">上传</button>
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
  </div>
  <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
  $(function(){
    hideimg();
    $(".radio input").click(function() {
      hideimg();
    });
    var options = {
        success: function (data) {
          if(data.status){
            $('#modal').modal('toggle');
            $("#image").val("/uploads/link/"+data.info);
          }else{
            alert(data.info);
          }
        }
    };
    $("#upload").ajaxForm(options);
  });
  function hideimg(){
    if($(".image").prop("checked"))
    {
      $(".imagebox").show();
    }
    else{
      $(".imagebox").hide();
      $("#image").val('');
    }
  }
</script>