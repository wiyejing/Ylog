<?php
/**
 * Database管理
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends Ylog_controller
{
  
  private $path; //文件备份路径
  function __construct()
  {
    parent::__construct();
    $this->path = $_SERVER['DOCUMENT_ROOT'].'/../';
  }

  /**
   * 数据库管理视图
   */
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
    $this->_view('database',$data);
  }

  /**
   * 删除备份文件
   * @param  string $file 文件名
   * @return 删除结果
   */
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
      if( ! $this->_del_file($filelink))
      {
        $bool = FALSE;
      }
    }
    
    if($file)
    {
      redirect('database');
    }
    else
    {
      echo $bool ? '批量删除成功！' : '批量删除失败！';
    }
  }

  private function _del_file($filelink)
  {
    $bool = TRUE;
    $filepath = $this->path.$filelink;
    $RES = is_file($filepath) && $filelink && preg_match('/^sql_.*sql$/i',$filelink);
    if( ! $RES)
    {
      $bool = FALSE;
      $this->_log('删除数据库备份文件 '.$filelink.'出错');
    }
    else
    {
      unlink($filepath);
      $this->_log('成功删除数据库备份文件 '.$filelink);
    }
    return $bool;
  }

  /**
   * 恢复备份
   * @param  string $file 文件路径
   * @return 结果
   */
  public function recovery($file)
  {
    $bool = TRUE;
    $filepath = $this->path.$file;

    if( ! is_file($filepath) && ! preg_match('/^sql_.*sql$/i',$file))
      $this->_log('文件 '.$file.' 不存在');

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
        $this->_log('sql备份文件出错');
      if (! $this->db->simple_query($sql))
      {
        $bool = FALSE;
      }
    }

    if($bool)
    {
      unset($_SESSION);
      session_destroy();
      $this->_log('恢复数据成功');
    }
    else
    {
      $this->_log('恢复数据失败');
    }
  }

  /**
   * 备份数据库
   * @param  string $pos 备份位置
   * @return 结果
   */
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
        $this->_log('备份数据库到 '.$filename.'.sql 文件');
        redirect('database/index');
      }
      else
      {
        $this->_log($this->path.' 目录不可写');
      }
    }
  }

  /**
   * 优化数据库
   * @return string 结果
   */
  public function optimize()
  {
    $this->load->dbutil();
    $result = $this->dbutil->optimize_database();
    if ($result !== FALSE)
    {
      $this->_log('数据库表优化成功');
      echo '数据库表优化成功';
    }
    else
    {
      $this->_log('数据库表优化失败');
      echo '数据库表优化失败';
    }
  }
}