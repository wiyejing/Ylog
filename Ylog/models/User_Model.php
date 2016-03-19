<?php
/**
 * 用户模型
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends Ylog_model
{
  private $tbname;
  
  function __construct()
  {
    parent::__construct();
    $this->tbname  = $this->db->dbprefix('member');
  }

  public function get_users()
  {
    $data = array();
    $this->db->order_by('uid', 'ASC');
    $query = $this->db->get($this->tbname);
    foreach ($query->result_array() as $row)
    {
      $data[] = $row;
    }
    return $data;
  }

  public function get_userinfo($uid)
  {
    $sql = "SELECT * FROM ".$this->tbname." WHERE uid=$uid";
    $query = $this->db->query($sql);
    $userinfo = array();
    foreach ($query->result_array() as $row)
    {
      $userinfo = $row;
    }
    return $userinfo;
  }

  public function add_user($data = array())
  {
    $data = $data ? $data : $this->input->post();
    $this->load->library('passwordhash',array(8, TRUE));
    $data['password'] = $this->passwordhash->HashPassword($data['password']);
    unset($data['password2']);
    $data['reg_ip'] = $this->input->ip_address();
    $data['reg_time'] = time();
    $data['status'] = 1;//默认启用
    return $this->db->insert($this->tbname, $data);
  }

  public function add_user_by_connect($data)
  {
    $data['reg_ip'] = $this->input->ip_address();
    $data['reg_time'] = time();
    $data['status'] = 1;//默认启用
    if($this->db->insert($this->tbname, $data))
    {
      return $this->db->insert_id();
    }
    else{
      return FALSE;
    }
  }

  public function get_userinfo_by_openid($openid)
  {
    $query = $this->db->select('*')
                ->limit(1)
                ->where('qq_openid',$openid)
                ->get($this->tbname);
    $row = $query->result_array();
    return $row['0'];
  }

  public function update_user($uid,$data = array())
  {
    $data = $data ? $data : $this->input->post();
    $this->db->where_in('uid', $uid);
    return $this->db->update($this->tbname, $data);
  }

  public function update_userpwd($uid)
  {
    $data = $this->input->post();
    $this->load->library('passwordhash',array(8, TRUE));
    $userinfo = $this->get_userinfo($uid);

    $res = $this->passwordhash->checkPassword($data['password'],$userinfo['password']);

    if($res)
    {
      $data['password'] = $this->passwordhash->HashPassword($data['newpassword']);
      unset($data['newpassword2']);
      unset($data['newpassword']);
      if($this->update_user($uid, $data))
      {
        return 1;
      }
      else{
        return 0;
      }
    }
    else
    {
      return -1;
    }
  }

  public function delete_user($uid)
  {
    $this->db->where_in('uid', $uid);
    return $this->db->delete($this->tbname); 
  }

  public function check_user($username,$password)
  {
    $this->load->library('passwordhash',array(8, TRUE));

    $this->db->where('username',$username);
    $this->db->select('uid, password,status');
    $query = $this->db->get($this->tbname);
    $row = $query->row();

    $status = 0;

    if( ! $row)
    {
      $status = -1;//用户不存在
    }
    elseif( ! $this->passwordhash->checkPassword($password,$row->password))
    {
      $status = -2;//密码不正确
    }
    elseif( ! $row->status)
    {
      $status = -3;//用户已禁用，请联系管理员！
    }
    else
    {
      $status = $row->uid;//登录成功
    }
    return $status;
  }

  public function get_name_by_uid($uid)
  {
    $query = $this->db->select('username')
             ->where('uid',$uid)
             ->limit(1)
             ->get($this->tbname);
    $row = $query->row();
    return $row->username;
  }


}