<?php
/**
 * 文档控制器
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends Ylog_controller
{
  private $_model;
  
  /**
   * 构造函数
   * 实例化模型类
   */
  function __construct()
  {
    parent::__construct();
    $this->load->model('document_model');
    $this->_model = $this->document_model;
  }

  /**
   * 获取文档树栏目json信息
   * @return json
   */
  public function tree_json()
  {
    $this->_model->get_tree_json();
  }

  /**
   * 管理父文档ID下的文档列表
   * @param  int $pid 父文档ID
   * @return 管理视图
   */
  public function manage($pid)
  {
    if(is_numeric($pid))
    {
      $data['pid'] = $pid;
      $data['title'] = $this->_model->get_title_by_id($pid);
      $this->_view('document_list',$data);
    }
    else{
      // 不存在该栏目
    }
  }

  /**
   * 根据父ID获取文档网格json信息
   * @param  int $pid 父文档ID
   * @return json
   */
  public function grid_json($pid=0)
  {
    if(is_numeric($pid))
    {
      $this->_model->get_grid_json($pid);
    }
    else{
      // 不存在该栏目
    }
  }

  /**
   * 新建文档
   * @param  int $pid 父ID
   * @return 新建文档视图
   */
  public function create($pid)
  {
    if(is_numeric($pid))
    {
      $data['pid'] = $pid;
      $data['title'] = $this->_model->get_title_by_id($pid);
      $this->_view('document_new',$data);
    }
    else{
      // 不存在该栏目
    }
  }

  /**
   * 保存文档信息
   * @return boolean 结果布尔值
   */
  public function save($id=0)
  {
    if($id)
    {
      $data = $this->input->post();
      $data['update_time'] = time();
      return $this->_model->edit_info($id,$data);
    }
    else
    {
      $data = $this->input->post();
      $data['uid'] = $this->session->userdata['uid'];
      $data['create_time'] = time();
      return $this->_model->save_info($data);
    }
  }

  /**
   * 删除文档信息
   * @return boolean 结果布尔值
   */
  
  public function del($bool = false)
  {
    $id = $this->input->post('id');
    if( ! is_array($id))
      return false;
    if($bool)
    {
      return $this->_model->del_info($id);
    }
    else
    {
      return $this->_model->recycle_info($id);
    }
  }

  /**
   * 编辑文章
   * @param  int $id 文档ID
   * @return 编辑视图
   */
  public function edit($id)
  {
    if(is_numeric($id))
    {
      $data = $this->_model->get_info($id);
      $data['ptitle'] = $this->_model->get_title_by_id($data['pid']);
      $this->_view('document_edit',$data);
    }
    else{
      // 不存在该栏目
    }
  }

  /**
   * 复制文档
   * @param  int or array $id 文档ID
   * @return boolean 复制结果
   */
  public function copy($id)
  {
    if(is_numeric($id))
    {
      return $this->_model->copy_info($id);
      // $this->_view('document_edit',$data);
    }
    else{
      // 不存在该栏目
    }
  }

  public function recycle()
  {
    $this->_view('document_recycle');
  }

  public function recycle_json()
  {
    $this->_model->get_recycle_json();
  }

  public function restore()
  {
    return $this->_model->restore_info($id);
  }
}