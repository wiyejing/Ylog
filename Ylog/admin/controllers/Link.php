<?php
/**
 * 友情链接
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class link extends Ylog_controller
{
  private $_model;
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('link_model');
    $this->_model = $this->link_model;
  }

  public function index()
  {
    # code...
  }

  public function manage()
  {
    $data['links'] = $this->_model->get_links();
    $this->_view('link_list',$data);
  }
  public function add($id = 0)
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('text', '链接名称', 'required',
      array('required' => '【%s】 不能为空！')
    );
    $this->form_validation->set_rules('url', '链接地址', 'required',
      array('required' => '【%s】 不能为空！')
    );
    if ($this->form_validation->run() == FALSE)
    {
      if($id)
      {
        $this->check_id($id); 
        $data = $this->_model->get_link($id);
      }
      else
      {
        $data['id'] = $id;
      }
      $this->_view('link_add',$data);
    }
    else
    {
      if( ! $this->_model->add_link($id))
      {
        $this->_message('编辑链接 失败',"right",site_url('link/index'));
      }
      else
      {
        $this->_message('编辑链接 成功',"right",site_url('link/index'));
      } 
    }
  }

  public function del($id = '0')
  {
    $this->check_id($id);
    if( ! $this->_model->del_links($id))
    {
      $this->_message('删除链接 失败',"wrong",site_url('link/index'));
    }
    else
    {
      $this->_message('删除链接 成功',"right",site_url('link/index'));
    }
  }

  public function edit($id)
  {
    $this->add($id);
  }

  private function check_id($id)
  {
    $bool = TRUE;//默认为真
    if(is_array($id))
    {
      foreach ($id as $value) {
        if( ! is_numeric($value))
          $bool = FALSE;
      }
    }
    else
    {
      if( ! is_numeric($id) || $id < 0)
        $bool = FALSE;
    }
    if( ! $bool) //小于0 或 非数字 不合法
    {
      $this->_message('ID 不合法',"wrong",site_url('link/index'));
    }
  }

  public function uploadimg()
  {
    $config['upload_path']      = '../uploads/link';
    $config['encrypt_name']     = TRUE;
    $config['allowed_types']    = 'gif|jpg|png';
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('linkimg'))
    {
      $status = 0;
      $info = $this->upload->display_errors('','');
    }
    else
    {
      $status = 1;
      $info = $this->upload->data('file_name');
    }
    $this->output
      ->enable_profiler(false)
      ->set_content_type('application/json')
      ->set_output(json_encode(array(
        'status' => $status,
        'info' => $info
        )))
      ->_display();
    exit();
  }

  public function disable($id = '0')
  {
    $this->check_id($id);
    if( ! $this->_model->is_enable_links($id,FALSE))
    {
      $this->_message('删除链接 出现错误',"wrong",site_url('link/index'));
    }
    else
    {
      redirect('link/index');
    }
  }

  public function enable($id = '0')
  {
    $this->check_id($id);
    if( ! $this->_model->is_enable_links($id,TRUE))
    {
      $this->_message('启用链接 出现错误',"wrong",site_url('link/index'));
    }
    else
    {
      redirect('link/index');
    }
  }

  public function savesort()
  {
    if($this->_model->save_sort())
    {
      redirect('link/index');
    }
    else
    {
      $this->_message('保存排序 出现错误',"wrong",site_url('link/index'));
    }
  }

  public function go($url)
  {
    if($url)
      header(urlencode($url));
  }

}