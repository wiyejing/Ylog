<?php
/**
 * 站点配置
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends Ylog_model
{
  private $tbname;
  
  function __construct()
  {
    parent::__construct();
    $this->tbname  = $this->db->dbprefix('config');
  }

  public function get_config($id = 1)
  {
    $this->db->where('id',$id);
    $query = $this->db->query("SELECT * FROM ".$this->tbname);
    $config = array();
    foreach ($query->result_array() as $row)
    {
      $config = $row;
    }
    return $config;
  }

  public function update_config($id = 1)
  {
    $data = $this->input->post();
    $where = "id='$id'";
    $sql = $this->db->update_string($this->tbname,$data,$where);
    return $this->db->query($sql);
  }
}