<?php
/**
 * OAuth
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
define('CONNECTQQ', APPPATH.'libraries/qqconnect/');

class Connect extends Ylog_controller
{
  
  function __construct()
  {
    parent::_init();
    require_once(CONNECTQQ."QC.class.php");
  }

  /**
   * QQ互联登录接口
   */
  public function qq()
  {
    $qc = new QC();
    $qc->qq_login();
  }
 
  /**
   * QQ互联回调接口
   */
  public function qqcallback()
  {
    $qc = new QC();
    $this->session->set_userdata('access_token', $qc->qq_callback());
    $this->session->set_userdata('openid', $qc->get_openid());
    redirect('connect/profile');
  }

  /**
   * QQ互联登录成功
   * @return QQ用户信息
   */
  public function profile()
  {
    // 从session中获取  access_token 和openid
    $data['qq_access_token'] = $this->session->userdata("access_token");
    $data['qq_openid'] = $this->session->userdata("openid");

    // 实例化接口，获取QQ用户信息
    $qc = new QC($data['qq_access_token'],$data['qq_openid']);
    $res = $qc->get_user_info();
    if( $res['ret'] < 0)
      show_error($res['msg'],500,'QQ互联登录失败！');

    // 组装注册信息
    // $regist_info = $this->set_regist_info($data,$res);
    
    // 实例化用户模型
    $this->load->model('user_model');

    //已登录
    if(parent::login_state())
    {
      // 根据UID获取登录用户信息
      $uid = $this->session->userdata['uid'];
      $userinfo = $this->user_model->get_userinfo($uid);
      
      // openid 已存在
      if($userinfo['qq_openid']) 
      {
        // 已存在 相同 openid，更新用户信息
        if($userinfo['qq_openid'] == $data['qq_openid']) 
        {
          $info['last_login_ip'] = $this->input->ip_address();
          $info['last_login_time'] = time();
          $this->user_model->update_user($uid,$info);
        }
        else{
          show_error('已绑定QQ，请用绑定QQ登录，或者解绑后重新绑定。',500,'QQ互联登录失败！');
        }
      }
      else // openid 不存在
      {
        $this->user_model->add_user_by_connect($uid,$regist_info);
      }
    }
    else{ //未登录
      $userinfo = $this->user_model->get_userinfo_by_openid($data['qq_openid']);

      // 已注册
      if($userinfo)
      {
        $info['last_login_ip'] = $this->input->ip_address();
        $info['last_login_time'] = time();
        $this->user_model->update_user($userinfo['uid'],$info);
        $this->session->set_userdata('uid', $userinfo['uid']);
        $this->session->set_userdata('username',$userinfo['username']);
      }
      // 未注册
      else{
        $info['username'] = $res['nickname'];
        $info['last_login_ip'] = $this->input->ip_address();
        $info['last_login_time'] = time();
        $info['photo'] = $res['figureurl_qq_2'];
        switch ($res['gender']) {
          case '男':
            $info['sex'] = 1;
            break;
          case '女':
            $info['sex'] = 2;
            break;
          default:
            $info['sex'] = 0;
            break;
        }

        $res = $this->user_model->add_user_by_connect($data);
        if( ! $res) //注册成功
        {
          $this->session->set_userdata('uid', $res);
          $this->session->set_userdata('username', $this>get_name_by_uid($res));
        }
        else
        {
          //注册失败
        }
      }
    }

    $userinfo = $this->user_model->get_userinfo($this->session->userdata['uid']);
    // 展示个人信息
    VD($userinfo);
  }

}