<?php
/**
 * 用户管理
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Ylog_controller
{
  private $_model;
  private $tbname;

  function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->_model = $this->user_model;
    $this->tbname = $this->db->dbprefix('member');
  }

  public function manage($a = '')
  {
    if($a == 'delete') //删除多用户
    {

    }
    elseif ($a == 'disabled') //禁用多用户
    {
      # code...
    }
    elseif ($a == 'enable') //启用多用户
    {
      # code...
    }
    else
    {
      $data['users'] = $this->_model->get_users();
      $this->_view('user_list',$data);
    }
  }

  public function add()
  {
    $config = array(
      array(
        'field' => 'username',
        'label' => '用户名',
        'rules' => 'trim|required|is_unique['.$this->tbname.'.username]',
        'errors' => array(
          'required' => '【%s】 不能为空！',
          'is_unique' => '【%s】 已存在！',
        ),
      ),
      array(
        'field' => 'password',
        'label' => '密码',
        'rules' => 'trim|required|min_length[6]',
        'errors' => array(
          'required' => '【%s】 不能为空！',
          'min_length' => '【%s】最少含有6个字符！',
        ),
      ),
      array(
        'field' => 'password2',
        'label' => '确认密码',
        'rules' => 'trim|required|matches[password]',
        'errors' => array(
          'required' => '【%s】 不能为空！',
          'matches' => '【%s】 不一致！',
        ),
      ),
      array(
        'field' => 'email',
        'label' => '电子邮箱',
        'rules' => 'trim|required|valid_email',
        'errors' => array(
          'required' => '【%s】 不能为空！',
          'valid_email' => '【%s】 无效！',
        ),
      )
    );
    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() == FALSE)
    {
      $this->_view('user_add');
    }
    else // 提交成功
    {
      if( ! $this->_model->add_user())
      {
        $this->_message('添加用户 失败，请重试!',"wrong");
      }
      else
      {
        $this->_message('恭喜您！添加用户 成功',"right",site_url('user/manage/'));
      }
    }
  }

  public function edit($uid = '')
  {
    if( ! is_numeric($uid))
      $uid = $this->session->userdata('uid');
    $data = $this->_model->get_userinfo($uid);
    if( ! $data){
      $this->_message('该用户不存在',"wrong",site_url('user/manage/'));
    }
    else
    {
      $reg_mobile = '/^((1\d{10})|(0\d{2,3}-\d{7,8}))$/';
      $reg_qq = '/^[1-9][0-9]{4,}$/';
      $config = array(
        array(
          'field' => 'mobile',
          'label' => '联系方式',
          'rules' => 'trim|regex_match['.$reg_mobile.']',
          'errors' => array(
            'regex_match' => '【%s】不是有效号码！',
          )
        ),
        array(
          'field' => 'email',
          'label' => '电子邮箱',
          'rules' => 'trim|required|valid_email',
          'errors' => array(
            'required' => '【%s】 不能为空！',
            'valid_email' => '【%s】 无效！',
          ),
        ),
        array(
          'field' => 'qq',
          'label' => 'QQ号码',
          'rules' => 'trim|regex_match['.$reg_qq.']',
          'errors' => array(
            'regex_match' => '【%s】 是不少于5位的纯数字',
          ),
        ),
      );
      $this->form_validation->set_rules($config);

      if ($this->form_validation->run() == FALSE)
      {
        $data['uid'] = $uid;
        $this->_view('user_edit',$data);
      }
      else //提交用户信息
      {
        if( ! $this->_model->update_user($uid))
        {
          $this->_message('提交用户信息 失败，请重试!',"wrong");
        }
        else
        {
          $this->_message('恭喜您！提交用户信息 成功',"right",site_url('user/manage/'));
        }
      }
    }
  }

  public function delete($uid = 0)
  {
    if( ! $uid)
      $uid = $this->input->post('uid');

    if( ! $this->_model->delete_user($uid))
    {
      $this->_message('删除用户 失败，请重试!',"wrong");
    }
    else
    {
      $this->_message('恭喜您！删除用户 成功',"right",site_url('user/manage/'));
    }
  }

  public function disabled($uid = 0)
  {
    if( ! $uid)
      $uid = $this->input->post('uid');
    $data['status'] = 0;
    $this->_model->update_user($uid,$data);
    redirect('user/manage/');
  }

  public function enable($uid = 0)
  {
    if( ! $uid)
      $uid = $this->input->post('uid');
    $data['status'] = 1;
    $this->_model->update_user($uid,$data);
    redirect('user/manage/');
  }

  public function updatepwd($uid = '')
  {
    $data = $this->input->post();
    if( ! $data)
    {
      $this->_view('user_pwd',$data);
    }
    else
    {
      if($data['newpassword'] != $data['newpassword2'])
      {
        echo '两次密码不一致！';
      }
      else
      {
        unset($data['newpassword2']);
        if($this->_model->check_user($this->session->userdata('username'),$data['password']) > 0)
        {
          $this->load->library('passwordhash',array(8, TRUE));
          $data['password'] = $this->passwordhash->HashPassword($data['newpassword']);
          unset($data['newpassword']);
          $this->_model->update_user($this->session->userdata('uid'),$data);
          echo '修改成功！';
        }
        else
        {
          echo "原密码错误！";
        }
      }
    }
  }

  public function info()
  {
    $data = $this->input->post();
    if( ! $data)
    {
      $this->_view('user_info',$data);
    }
  }

  public function do_updatepwd()
  {
    # code...
  }

}
