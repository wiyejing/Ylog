<?php
/**
 * 文件上传管理插件
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder/elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder/elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder/elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder/elFinderVolumeLocalFileSystem.class.php';

function access($attr, $path, $data, $volume) {
  return strpos(basename($path), '.') === 0  
    ? !($attr == 'read' || $attr == 'write') 
    :  null;                                 
}

class elFinderUpload
{
  function __construct($opts)
  {
    $connector = new elFinderConnector(new elFinder($opts));
    $connector->run();
  }
}