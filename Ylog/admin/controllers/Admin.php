<?php
/**
 * 后台入口
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Ylog_controller {

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['server'] = php_uname('s');
    $data['db_prefix'] = $this->db->dbprefix;
    $data['db_version'] = $this->db->version();
    $data['upload_size'] = ini_get('upload_max_filesize');

    $this->load->library('user_agent');
    if ($this->agent->is_browser())
    {
        $agent = $this->agent->browser().' '.$this->agent->version();
    }
    elseif ($this->agent->is_robot())
    {
        $agent = $this->agent->robot();
    }
    elseif ($this->agent->is_mobile())
    {
        $agent = $this->agent->mobile();
    }
    else
    {
        $agent = '无法识别来访客户';
    }

    $data['agent'] = $agent;
    $data['platform'] = $this->agent->platform();

    $this->_view('index',$data);
  }
  public function site(){
    // redirect("http://localhost/CodeIgniter");
  }
}
