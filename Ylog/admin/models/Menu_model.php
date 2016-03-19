<?php
/**
 * 菜单模型
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends Ylog_model
{
  private $tbname;
  function __construct()
  {
    parent::__construct();
    $this->tbname  = $this->db->dbprefix('menu');
  }

  public function get_tree_json($mid)
  {
    $data = $this->get_menu($mid);
    $this->_generate_json($data);
  }

  public function get_menu($mid)
  {
    $menus = array();
    $query = $this->db->select('*')
             ->where('pid',$mid)
             ->get($this->tbname);
    foreach ($query->result_array() as $row)
    {
      $items = array();
      $items['id'] = $row['mid'];
      $items['text'] = $row['title'];
      $items['state'] = 'open';
      if($row['url'])
        if(preg_match('/http/i', $row['url']))
        {
          $items['attributes'] = array(
                                "url" => urlencode($row['url'])
                              );
        }
        else
        {
          $items['attributes'] = array(
                                "url" => site_url($row['url'])
                              );
        }
      if($this->has_child($row['mid']))
        $items['children'] = $this->get_menu($row['mid']);
      array_push($menus, $items);
    }
    return $menus;
  }

  public function get_grid_json()
  {
    $menus = $this->get_grid(0);
    return $this->_generate_json($menus);
  }

  public function get_grid($pid)
  {
    $result = array();
    $query = $this->db->select('*')
             ->where('pid',$pid)
             ->order_by('sort')
             ->get($this->tbname);

    foreach ($query->result_array() as $row) {
      // VD($row);
      $node = $row;
      $node['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
      $node['pid'] = $this->get_title_by_id($row['pid']);
      $has_child = $this->has_child($row['mid']);
      // $node['state'] =  $has_child ? 'closed' : 'open';
      $children = $this -> get_grid($row['mid']);
      if($children)
      {
        $node['children'] = $children;
      }
      array_push($result, $node);
    }
    return $result;
  }

  public function get_title_by_id($id)
  {
    if($id == 0)
    {
      return '菜单';
    }
    else
    {
      $query = $this->db->select('title')
               ->where('mid', $id)
               ->limit(1)
               ->get($this->tbname);
      $row = $query->row();
      return $row->title;
    }
  }

  public function has_child($id)
  {
    $query = $this->db->query("select count(*) as sum from ".$this->tbname." where pid=$id");
    $row = $query->row_array();
    return $row['sum'] > 0 ? true : false;
  }
} 