<?php
/**
 * 前台首页
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{

  function __construct( )
  {
    parent::__construct();
    $this->output->enable_profiler(TRUE);
  }

  public function index()
  {
    echo "首页";
  }
}
