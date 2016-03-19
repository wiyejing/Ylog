<?php
/**
 * 链接模型
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Link_model extends Ylog_model
{

  private $tbname;
  
  function __construct()
  {
    parent::__construct();
    $this->tbname = $this->db->dbprefix('url');
  }

  public function get_links()
  {
    $links = array();
    $this->db->order_by('sort ASC, id ASC');
    $query = $this->db->get($this->tbname);
    foreach ($query->result_array() as $row)
    {
      $links[] = $row;
    }

    return $links;
  }

  public function get_link($id)
  {
    $link = array();
    $this->db->where('id',$id);
    $query = $this->db->get($this->tbname);
    foreach ($query->result_array() as $row)
    {
      $link = $row;
    }

    return $link;
  }

  public function add_link($id = 0)
  {
    $data = $this->input->post();
    $data['create_time'] = time();
    if($id)
    {
      $this->db->where('id',$id);
      return $this->db->update($this->tbname,$data);
    }
    else
    {
      return $this->db->insert($this->tbname, $data);
    }
  }

  public function del_links($id)
  {
    if( ! $id)
    {
      $data = $this->input->post();
      $id = $data['linkid'];
    }
    $this->db->where_in('id',$id);
    return $this->db->delete($this->tbname);
  }

  public function is_enable_links($id,$bool)
  {
    if( ! $id)
    {
      $id = $this->input->post('linkid');
    }
      
    $data['status'] = $bool ? '1' : '0';
    $this->db->where_in('id',$id);
    return $this->db->update($this->tbname,$data);
  }

  public function save_sort()
  {
    $sort = $this->input->post('sort');
    $res = TRUE;
    foreach ($sort as $key => $value) {
      $data['sort'] = $value;
      $this->db->where('id',$key);
      if( ! $this->db->update($this->tbname,$data))
        $res = FALSE;
    }
    return $res;
  }
  public function get_sum()
  {
    return $this->db->count_all($this->tbname);
  }
}