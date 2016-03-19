<?php
/**
 * 验证码图片
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_controller
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $config = array(
      'imageH' => 58,
      'imageW' => 290,
      'fontttf' => '6.ttf',
    );
    $this->load->library('captcha',$config);
    $this->captcha->entry();
  }

}