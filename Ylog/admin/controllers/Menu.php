<?php
/**
 * 菜单管理控制器
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Ylog_controller
{

  private $_model;
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('menu_model');
    $this->_model = $this->menu_model;
  }

  public function tree_json($id)
  {
    if( ! is_numeric($id))
      return false;
    $this->_model->get_tree_json($id);
  }

  public function manage()
  {
    $this->_view('menu_list');
  }

  public function grid_json()
  {
    $this->_model->get_grid_json(0);
  }

  public function create()
  {
    # code...
  }
}