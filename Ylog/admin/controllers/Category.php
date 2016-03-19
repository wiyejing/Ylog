<?php
/**
 * 分类
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Ylog_controller
{
  private $_model;
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('category_model');
    $this->_model = $this->category_model;
/*    
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');*/
  }

  public function index()
  {
    if($this->_model->get_cats('0'))
    {
      redirect('category/manage');
    }
    else
    {
      $this->_message('当前无分类，请添加分类！','warm',site_url('category/add'));
    }
  }

  /**
   * 分类列表
   * @param  string $id 根据ID获取其三级子分类
   * @return void
   */
  public function manage($id = "0")
  {
    if ( ! is_numeric($id))
      show_404();

    $data['pid'] = $id;//新增分类 pid

    $data['query'] = $this->_model->get_cats($id);
    if ( ! $data['query'])
      show_404();

    $this->_view("category_list",$data);
  } 

  /**
   * 新增分类
   * @param string $pid 新增子分类
   * @return void
   */
  public function add($pid = '0')
  {

    $this->form_validation->set_rules('title', '分类名称', 'required',
      array('required' => '【%s】 不能为空！')
    );
    
    $data['pid'] = $pid;
    $data['cats'] = $this->_model->get_cats('0');

    if ($this->form_validation->run() == FALSE)
    {
      $this->_view("category_add",$data);
    }
    else // 提交成功
    {
      if( ! $this->_model->add_cat())
      {
        $this->_message('新增分类 失败，请重试!',"wrong");
      }
      else
      {
        $this->_message('恭喜您！新增分类 成功',"right",site_url('category/manage/'.$pid));
      }
    }

  }

  /**
   * 删除分类
   * @param  string $id 分类ID
   * @return void
   */
  public function delete($id = '0')
  {

    if ( ! $id)
      $this->_model->delete_cats();
    if( ! $this->_model->delete_cat($id))
    {
      $this->_message('删除分类 失败，请重试!',"wrong");
    }
    else
    {
      $this->_message('恭喜您！删除分类 成功',"right",site_url('category/index'));
    }
  }

  public function batch_delete()
  {
    $data = $this->input->post();
    VD($data);
  }


  /**
   * 编辑分类
   * @param  mix $id 分类ID
   * @return void
   */
  public function edit($id)
  {
    if( ! is_numeric($id))
      show_404();
    $data = $this->_model->get_catinfo($id);
    if(! $data)
      $this->_message('该分类不存在',"wrong");

    $this->load->library('form_validation');
    $this->form_validation->set_rules('title', '分类名称', 'required',
      array('required' => '【%s】 不能为空！')
    );

    if ($this->form_validation->run() == FALSE)
    {
      $data['cats'] = $this->_model->get_cats('0');
      $this->_view("category_edit",$data);
    }
    else
    {
      if( ! $this->_model->update_cat($id))
      {
        $this->_message('修改分类 失败，请重试!',"wrong");
      }
      else
      {
        $this->_message('恭喜您！修改分类 成功',"right",site_url('document/manage/'.$id));
      }
    }
  }
}