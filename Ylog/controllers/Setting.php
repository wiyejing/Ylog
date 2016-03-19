<?php
/**
 * 后台设置
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Ylog_controller
{
  
  private $_model;
  function __construct()
  {
    parent::__construct();
    $this->load->model('setting_model');
    $this->_model = $this->setting_model;
    
  }

  public function index()
  {
    $this->load->library('form_validation');
    // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('site_name', '站点名称', 'required',
      array('required' => '【%s】 不能为空！')
    );

    if ($this->form_validation->run() == FALSE)
    {
      $data = $this->_model->get_config();
      $this->_view('config_site',$data);
    }
    else
    {
      if($this->_model->update_config())
      {
        redirect('setting');
      }
      else
      {
        $this->_message('更新配置出错，请重试！','warm',site_url('setting'));
      }
    }
  }
  public function email()
  {
    if ($this->input->post()) {
      if($this->_model->update_config())
      {
        redirect('setting/email');
      }
      else
      {
        $this->_message('更新邮件配置出错，请重试！','warm',site_url('setting/email'));
      }
    }
    $data = $this->_model->get_config();
    $this->_view('config_email',$data);
  }
  public function close()
  {
    $data = $this->_model->get_config();
    $this->_view('config_close',$data);
  }
  public function other()
  {
  }
  public function test()
  {
    // $smtp_to = $this->input->get('smtp_to');
    $this->output->enable_profiler(FALSE);
    $data = $this->input->post();
    // VD($data);

    $this->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = $data['smtp_host'];
    $config['smtp_user'] = $data['smtp_from'];
    $config['smtp_pass'] = $data['smtp_pwd'];//填写腾讯邮箱开启POP3/SMTP服务时的授权码，即核对密码正确
    $config['smtp_port'] = $data['smtp_port'];
    $config['charset'] = 'utf-8';
    $config['smtp_timeout'] = 30;
    $config['mailtype'] = 'text';
    $config['wordwrap'] = TRUE;
    $config['crlf'] = PHP_EOL;
    $config['newline'] = PHP_EOL;

    $this->email->initialize($config);

    $this->email->from($data['smtp_from'], $data['smtp_user']);
    $this->email->to($data['smtp_to']);
    $this->email->subject('Email Test 邮件测试)');
    $this->email->message("Testing the email class.If you can see this,it\'s show that the email system and configuration is running!\n\r\n\r正在测试email类。如果你能看到这封邮件，表明邮件系统和配置正常！");
    return $this->email->send();
  }
}