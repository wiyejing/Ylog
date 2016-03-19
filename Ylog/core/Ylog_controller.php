<?php
/**
 * 后台控制器基类
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Ylog_controller extends CI_Controller
{
  private $copyright = 'Powered By Ylog';
  private $uid; //当前登录ID
  private $username; //当前登录用户名

  function __construct()
  {
    $this->_init();
    $this->check_login();
    $this->uid = $this->session->userdata['uid'];
    $this->username = $this->session->userdata['username'];
    if (ENVIRONMENT === 'development') {
      // $this->output->enable_profiler(TRUE);
    }
  }

  /**
   * 初始化基类
   * @return  启用常用类
   */
  protected function _init()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper(array('url','form','ylog'));
  }

  protected function check_login()
  {
    if ( ! $this->login_state())
    {
      unset($_SESSION);
      // session_destroy();
      redirect('login?url='.uri_string());
    }
  }

  protected function login_state()
  {
    if ( $this->session->userdata('uid') && $this->session->userdata('username'))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  protected function _view($template, $data = array(),$only = FALSE)
  {
    // $interval = 60 * 60 * 24 * 7; // 6 hours
    // $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
    // $this->output->set_header("Expires: " . gmdate ("r", (time() + $interval)));
    // $this->output->set_header('Cache-Control: max-age=21600');
    // $this->output->set_header('Pragma: public');

    $data['copyright'] = $this->copyright;
    $data['cuid'] = $this->uid;
    $data['cname'] = $this->username;
    if($only)
    {
      $this->load->view($template,$data);
    }
    else
    {
      $this->load->view('include/meta',$data);
      $this->load->view($template,$data);
    }
  }

  protected function _message($msg,$state,$url="javascript:history.go(-1);")
  {
    $data = array(
      'copyright' => $this->copyright,
      'tips' => $msg,
      'state' => $state,
      'url' => $url,
    );
    $this->load->view('message',$data);
    $this->output->_display();
    exit();
  }

  protected function _log($msg)
  {
    log_message('error',$msg.' - '.$this->username);
  }
}
