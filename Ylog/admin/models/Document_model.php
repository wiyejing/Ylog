<?php
/**
 * 文档模型
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends Ylog_model
{
  
  private $tbname;

  function __construct()
  {
    parent::__construct();
    $this->tbname  = $this->db->dbprefix('document');
  }
  
  /**
   * 获取文档树json数据
   * @return json
   */
  public function get_tree_json()
  {
    $docs = $this -> get_tree(0);
    return $this->_generate_json($docs);
  }

  /**
   * 根据父文档ID递归获取所有子文档数组
   * @param  int $pid 父文档ID
   * @return array    文档数组
   */
  public function get_tree($pid)
  {
    $result = array();
    $query = $this->db->select('*')
             ->where('display', 'Y')
             ->where('pid',$pid)
             ->order_by('sort')
             ->order_by('id','DESC')
             ->get($this->tbname);
    foreach ($query->result_array() as $row)
    {
      $node = array();
      $node['id'] = $row['id'];
      $node['text'] = $row['title'];
      $node['state'] = $this->has_child($row['id']) ? 'open' : 'closed';
      $url = $row['template'] ? $row['template'] : 'document/manage/'.$row['id'];
      $node['attributes'] = array(
                              "url" => site_url($url)
                            );
      $children = $this -> get_tree($row['id']);
      if($children && $row['state'] == 'Y')
      {
        $node['children'] = $children;
      }
      else
      {
        $node['state'] = 'open';
      }
      array_push($result,$node);
    }
    return $result;
  }

  /**
   * 获取文档总数
   * @return int 文档数
   */
  public function get_sum()
  {
    return $this->db->count_all($this->tbname);
  }

  /**
   * 判断是否有子文档
   * @param  int  $id 文档ID
   * @return boolean
   */
  public function has_child($id)
  {
    $query = $this->db->query("select count(*) as sum from ".$this->tbname." where pid=$id and display='Y'");
    $row = $query->row_array();
    return $row['sum'] > 0 ? true : false;
  }

  /**
   * 根据父文档ID获取文档json数据
   * @param  int $pid 父文档ID 
   * @return json
   */
  public function get_grid_json($pid)
  {
    $page = $this->input->post('page');
    $rows = $this->input->post('rows');
    $id = $this->input->post('id');
    $title = $this->input->post('title');

    $page = isset($page) ? intval($page) : 1;
    $rows = isset($rows) ? intval($rows) : 10;

    $id = isset($id) ? $id : '';
    $title = isset($title) ? $title : '';

    $offset = ($page-1)*$rows;

    $result = array();

    // 获取结果总数
    $query = $this->db->select('*')
             ->where('pid', $pid)
             ->where('display', 'Y')
             ->like('id',$id)
             ->like('title',$title)
             ->get($this->tbname);

    $result["total"] = $query->num_rows();

    // 获取结果详细数组
    $query = $this->db->select('*')
             ->where('pid', $pid)
             ->where('display', 'Y')
             ->like('id',$id)
             ->like('title',$title)
             ->order_by('sort')
             ->order_by('id', 'DESC')
             ->limit($rows,$offset)
             ->get($this->tbname);
    $items  = array();
    foreach ($query->result_array() as $row)
    {
      $row['children'] = $this->has_child($row['id']) ? 'y' : 'n';
      $row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
      
      $this->load->model('user_model');
      $row['uid'] = $this->user_model->get_name_by_uid($row['uid']);
      
      array_push($items, $row);
    }
    $result['rows'] = $items;

    return $this->_generate_json($result);
  }

  /**
   * 根据ID读取文档标题
   * @param  int $id 文档ID
   * @return string   文档标题
   */
  public function get_title_by_id($id)
  {
    $query = $this->db->select('title')
             ->where('id', $id)
             ->limit(1)
             ->get($this->tbname);
    $row = $query->row();
    if (isset($row))
    {
      return $row->title;
    }
  }

  /**
   * 保存文档信息
   * @return boolean 结果布尔值
   */
  public function save_info($data)
  {
    return $this->db->insert($this->tbname, $data);
  }

  public function edit_info($id,$data)
  {
    $this->db->where('id', $id);
    return $this->db->update($this->tbname, $data);
  }

  /**
   * post方式删除文档
   * @param array $data['id'] 文档ID数组
   * @return boolean
   */
  public function del_info($id)
  {
    $this->db->where_in('id',$id);
    return $this->db->delete($this->tbname);
  }

  /**
   * 删除文档到回收站
   * @return boolean
   */
  public function recycle_info($id)
  {
    $data = array('display' => 'N');
    $this->db->where_in('id',$id);
    return $this->db->update($this->tbname,$data);
  }

  /**
   * 恢复文档
   * @return [type] [description]
   */
  public function restore_info()
  {
    $data = array('display' => 'Y');
    $this->db->where_in('id',$id);
    return $this->db->update($this->tbname,$data);
  }

  public function get_info($id)
  {
    $query = $this->db->select('*')
             ->where('id', $id)
             ->limit(1)
             ->get($this->tbname);
    $row = $query->result_array();
    return $row['0'];
  }

  public function copy_info($id)
  {

    $query = $this->db->select('*')
            ->where('id',$id)
            ->get($this->tbname);
    $data = $query->result_array();
    $data = $data['0'];
    unset($data['id']);
    $data['create_time'] = time();
    return $this->db->insert($this->tbname,$data);
  }

  public function get_recycle_json()
  {
    $page = $this->input->post('page');
    $rows = $this->input->post('rows');
    $id = $this->input->post('id');
    $title = $this->input->post('title');

    $page = isset($page) ? intval($page) : 1;
    $rows = isset($rows) ? intval($rows) : 10;

    $id = isset($id) ? $id : '';
    $title = isset($title) ? $title : '';

    $offset = ($page-1)*$rows;

    $result = array();

    // 获取结果总数
    $query = $this->db->select('*')
             ->where('display', 'N')
             ->like('id',$id)
             ->like('title',$title)
             ->get($this->tbname);

    $result["total"] = $query->num_rows();

    // 获取结果详细数组
    $query = $this->db->select('*')
             ->where('display', 'N')
             ->like('id',$id)
             ->like('title',$title)
             ->order_by('sort')
             ->order_by('id', 'DESC')
             ->limit($rows,$offset)
             ->get($this->tbname);
    $items  = array();
    foreach ($query->result_array() as $row)
    {
      $row['children'] = $this->has_child($row['id']) ? 'y' : 'n';
      $row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
      $row['pid'] = $this->get_title_by_id($row['pid']);
      
      $this->load->model('user_model');
      $row['uid'] = $this->user_model->get_name_by_uid($row['uid']);
      
      array_push($items, $row);
    }
    $result['rows'] = $items;

    return $this->_generate_json($result);
  }

}