<?php
/**
 * 用户登录
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{
  private $_model;

  function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('user_model');
    $this->_model = $this->user_model;
  }

  /**
   * 后台登录界面
   * @return 登录视图/跳转到管理界面
   */
  public function index()
  {
    if ($this->session->userdata("uid")) {
      redirect();
    }
    else
    {
      $url = $this->input->get('url');
      $data['url'] = $url ? 'login/do_login?url='.$url : 'login/do_login';

      $this->load->view("login",$data);
    }
  }

  /**
   * 登录提交
   * @return [type] [description]
   */
  public function do_login()
  {
    $username = $this->input->post('username', TRUE);
    $password = $this->input->post('password', TRUE);
    $verify = $this->input->post('verify', TRUE);
    $this->load->library('captcha');
    if( ! $this->captcha->check($verify))
    {
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(array(
          'status' => -4,
          'info' => '验证码不正确'
          )))
        ->_display();
      exit();
    }

    if( ! $username || ! $password)
    {
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(array(
          'status' => 0,
          'info' => '用户名和密码不能为空'
          )))
        ->_display();
      exit();
    }

    $status = $this->_model->check_user($username,$password);
    if(is_int($status))
    {
      $info = '';
      if($status == -1 || $status == -2)
      {
        $info = '用户或密码不正确';
      }
      elseif($status == -3)
      {
        $info = '用户已禁用，请联系管理员！';
      }
      else
      {
        $info = '网站出现严重问题，请联系管理员！';
      }
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(array('status' => $status,'info' => $info)))
        ->_display();
      die();
    }
    else
    {
      $uid = $status;
      $this->session->set_userdata('uid', $uid);
      $this->session->set_userdata('username', $username);
      $data['last_login_ip'] = $this->input->ip_address();
      $data['last_login_time'] = time();
      $this->_model->update_user($uid,$data);
      $url = $this->input->get('url');//跳转地址
      if( ! $url){
        $url = '';
      }
      $url = site_url($url);
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(array('status' => $status, 'url' => $url )))
        ->_display();
      exit;
    }
  }

  /**
   * 登出提交
   * @return [type] [description]
   */
  public function do_logout()
  {
    session_destroy();
    redirect('/login');
  }


}
