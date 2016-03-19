<?php
/**
 * 分类模型
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends Ylog_model
{
  private $tbname;
  function __construct()
  {
    parent::__construct();
    $this->tbname  = $this->db->dbprefix('category');
  }

  public function get_sum()
  {
    return $this->db->count_all($this->tbname);
  }
}