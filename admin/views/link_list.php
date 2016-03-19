<?php
/**
 * 友情链接
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content link_lst">
  <h1>链接管理</h1>
  <div class="btn-group mb20">
    <?php echo anchor('link/add','新增','class="btn"') ?>
    <a href="javascript:;" data-url="<?php echo site_url('link/del'); ?>" class="btn del">批量删除</a>
    <a href="javascript:;" data-url="<?php echo site_url('link/disable'); ?>" class="btn disable" role="submit">批量禁用</a>
    <a href="javascript:;" data-url="<?php echo site_url('link/enable'); ?>" class="btn enable">批量启用</a>
    <a href="javascript:;" data-url="<?php echo site_url('link/savesort'); ?>" class="btn save">保存排序</a>
  </div>
  <table class="table table-bordered table-condensed" width="100%">
    <thead>
      <tr>
        <th width="15"><input type="checkbox" class="check-all"></th>
        <th width="80" align="center">排序</th>
        <th>ID</th>
        <th>名称</th>
        <th>链接</th>
        <th>描述</th>
        <th>类型</th>
        <th>创建时间</th>
        <th>状态</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <form action="" id="link" method="post">
        <?php foreach ($links as $link): ?>
        <tr>
          <td><input type="checkbox" class="ids" value="<?=$link['id']?>" name="linkid[]"></td>
          <td><input class="no" type="text" name="sort[<?=$link['id']?>]" value="<?=$link['sort']?>" style="width: 80px"></td>
          <td><?=$link['id']?></td>
          <td><?=$link['text']?></td>
          <td><a href="<?=$link['url']?>" target="_blank"><?=$link['url']?></a></td>
          <td><?=$link['description']?></td>
          <td><?=$link['type'] == 1 ? '文字型':'<a title="'.$link['text'].'" href="..'.$link['image'].'" rel="linkimg">图片型</a>'?></td>
          <td><?=date('Y-m-d',$link['create_time'])?></td>
          <td><?=$link['status'] == 1 ? '启用':'禁用'?></td>
          <td>
            <?php echo anchor('link/edit/'.$link['id'],'编辑');?>
            <?php echo anchor('link/del/'.$link['id'],'删除');?>
            <?php echo anchor('link/disable/'.$link['id'],'禁用');?>
            <?php echo anchor('link/enable/'.$link['id'],'启用');?>
          </td>
        </tr>
        <?php endforeach; ?>
      </form>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(function(){
    $("a[rel=linkimg]").fancybox({
      padding: 0,
      helpers : {
        title : {
          type : 'over'
        },
        overlay : {
          css : {
            'background' : 'rgba(100,100,100,0.85)'
          }
        }
      }
    });
    $(".disable,.del,.enable").click(function(){
      var form = $("#link");
      form.attr('action', $(this).attr('data-url'));
      var option = $(".ids");
      var bool;
      option.each(function(i){
        if(this.checked){
          bool =  true;
        }
      });
      bool ? form.submit() : alert("请先选择待操作链接");
    });
    $(".save").click(function(){
      $("#link").attr('action', $(this).attr('data-url')).submit();
    });
  })
</script>