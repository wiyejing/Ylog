<?php
/**
 * 友情链接
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content link">
  <?php echo form_open_multipart('link/add','class="form-horizontal" name="link"'); ?>
    <fieldset>
      <legend>添加链接</legend>

      <div class="control-group">
        <label class="control-label" for="text">链接名称：</label>
        <div class="controls">
          <input type="text" id="text" name="text" value="<?=$text?>">
          <span class="help-inline"><small class="error">*</small><?php echo form_error('text'); ?></span>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="url">链接地址：</label>
        <div class="controls">
          <input type="text" id="url" name="url" value="<?=$url?>">
          <span class="help-inline"><small class="error">*</small><?php echo form_error('url'); ?></span>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="description">链接描述：</label>
        <div class="controls">
          <input type="text" id="description" name="description" value="<?=$image?>">
          <!-- <span class="help-inline"><small>(名称不能为空)</small></span> -->
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="image">链接图片：</label>
        <div class="controls">
          <input type="file" id="image" name="image" value="<?=$image?>">
          <span class="help-inline">
          <?php echo $error ?>
          </span>
          <span class="help-block"><small>(图片大小不能超过 1024KB，格式可为 gif、jpg或png)</small></span>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">链接类型：</label>
        <div class="controls">
          <label><input type="radio" <?=$type==1?'checked':''?> value="1" name="type">文字型</label>
          <label><input type="radio" <?=$type==2?'checked':''?> value="2" name="type">图片型</label>
        </div>
      </div>

      <div class="form-actions">
        <input type="submit" class="btn btn-primary" value="保存">
        <input type="reset" class="btn" value="重置">
      </div>
    </fieldset>
  <?php echo form_close(); ?>
</div>