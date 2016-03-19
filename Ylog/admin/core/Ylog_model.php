<?php
/**
 * 模型基类
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Ylog_model extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }

  /**
   * 用数组生成JSON数据
   * @param  array $data 需要生成JSON的数据
   * @return json       JSON数据
   */
  protected function _generate_json($data)
  {
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($data));
  }

}