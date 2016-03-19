<?php
/**
 * 数据库管理
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Db extends Ylog_controller
{
  private $path;
  function __construct()
  {
    parent::__construct();
    $this->path = $_SERVER['DOCUMENT_ROOT'].'/../';
  }

  public function index()
  {
    $this->load->helper('file');
    $files = get_dir_file_info($this->path);
    $fileinfo = array();
    foreach ($files as $file) {
      if(is_file($file['server_path']) && preg_match('/^sql_.*sql$/i',$file['name']))
      {
        $fileinfo[] = get_file_info($file['server_path']);
      }
    }
    $date = array();
    foreach ($fileinfo as $value) {
      $date[]=$value['date'];
    }
    array_multisort($date,$fileinfo);//按备份时间排序

    $data['files'] = $fileinfo;
    $this->_view('db_bak',$data);
  }

  public function del($file = NULL)
  {
    if( ! $file && $this->input->post())
    {
      $files = $this->input->post();
    }
    else
    {
      $files['file'] = array($file);
    }

    $bool = TRUE;
    foreach ($files['file'] as $filelink) {
      # code...
      $filepath = $this->path.$filelink;
      $RES = is_file($filepath) && $filelink && unlink($filepath) && preg_match('/^sql_.*sql$/i',$filelink);
      if( ! $RES)
      {
        $bool = FALSE;
      }
    }

    $bool ? redirect('db/index') : $this->_message('删除文件出错，请重试','wrong');
  }

  public function recovery($file)
  {
    $sqls = '';
    $bool = TRUE;
    $filepath = $this->path.$file;

    if( ! is_file($filepath) && ! preg_match('/^sql_.*sql$/i',$file))
      $this->_message('文件 '.$file.' 不存在','wrong');

    foreach (file($filepath) as $v) {//过滤文件中的空行和注释，并转成数组
      $v = trim($v);
      if($v != "\n" && $v && $v[0] !='#')
      {
        $sql_arr[] = $v;
      }
    }
    $array_sql = array_filter(preg_split("/;/", implode($sql_arr)));//数组->字符串->数组
    foreach($array_sql as $sql){
      if( ! $sql )
        $this->_message('文件出错','wrong');
      if (! $this->db->simple_query($sql))
      {
        $bool = FALSE;
      }
    }
    if($bool)
    {
      unset($_SESSION);
      session_destroy();
      $this->_message('恢复数据成功','right',site_url('login'));
    }
    else
    {
      $this->_message('恢复数据失败','wrong');
    }
  }

  public function bak($pos = '')
  {
    $filename = 'sql_'.date('Ymd_',time()).md5(time());
    $this->load->dbutil();

    if($pos == 'local') //备份到本地
    {
      $prefs = array(
        'format'    => 'zip',           // gzip, zip, txt
        'filename'  => $filename.'.sql',      // File name - NEEDED ONLY WITH ZIP FILES
      );
      $backup = $this->dbutil->backup($prefs);
      $this->load->helper('download');
      force_download($filename.'.zip', $backup);
    }
    else //备份到服务器网站根目录上级目录
    {
      $prefs = array(
        'format'    => 'txt',           // gzip, zip, txt
        'filename'  => $filename.'.sql',      // File name - NEEDED ONLY WITH ZIP FILES
      );
      $backup = $this->dbutil->backup($prefs);
      $this->load->helper('file');
      if(is_really_writable($this->path))
      {
        write_file($this->path.$filename.'.sql', $backup);
        redirect('db/index');
      }
      else
      {
        $this->_message($this->path.' 目录不可写','wrong');
      }
    }
  }

  public function optimize()
  {
    $this->load->dbutil();
    $result = $this->dbutil->optimize_database();
    if ($result !== FALSE)
    {
      $this->_message('数据库表优化成功','right');
    }
    else
    {
      $this->_message('数据库表优化失败','wrong');
    }
  }
}