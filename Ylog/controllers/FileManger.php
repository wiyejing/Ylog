<?php
/**
 * 文件上传控制器
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class FileManger extends Ylog_controller
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->_view('filemanger','',true);
  }

  public function init()
  {
    $this->load->helper('path');
    $opts = array(
/*      'bind' => array(
        'upload.presave' => array(
          'Plugin.AutoResize.onUpLoadPreSave'
        ),
        'upload.pre mkdir.pre mkfile.pre rename.pre archive.pre' => array(
          'Plugin.Normalizer.cmdPreprocess'
        ),
        'upload.presave' => array(
          'Plugin.Normalizer.onUpLoadPreSave'
        ),
        'upload.pre mkdir.pre mkfile.pre rename.pre archive.pre' => array(
          'Plugin.Sanitizer.cmdPreprocess'
        ),
        'upload.presave' => array(
          'Plugin.Sanitizer.onUpLoadPreSave'
        ),
        'upload.presave' => array(
          'Plugin.Watermark.onUpLoadPreSave'
        )
      ),
      // global configure (optional)
      'plugin' => array(
        'AutoResize' => array(
          'enable'         => true,       // For control by volume driver
          'maxWidth'       => 1024,       // Path to Water mark image
          'maxHeight'      => 1024,       // Margin right pixel
          'quality'        => 95,         // JPEG image save quality
          'preserveExif'   => false,      // Preserve EXIF data (Imagick only)
          'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP // Target image  rmats ( bit-field )
        ),
        'Normalizer' => array(
          'enable'    => true,
          'nfc'       => true,
          'nfkc'      => true,
          'lowercase' => false,
          'convmap'   => array()
        ),
        'Sanitizer' => array(
          'enable' => true,
          'targets'  => array('\\','/',':','*','?','"','<','>','|'), // target chars
          'replace'  => '_'    // replace to this
        ),
        'Watermark' => array(
          'enable'         => true,       // For control by volume driver
          'source'         => 'logo.png', // Path to Water mark image
          'marginRight'    => 5,          // Margin right pixel
          'marginBottom'   => 5,          // Margin bottom pixel
          'quality'        => 95,         // JPEG image save quality
          'transparency'   => 70,         // Water mark image transparency ( other than PNG )
          'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
          'targetMinPixel' => 200         // Target image minimum pixel size
        )
      ),*/
      'roots' => array(
        array( 
          'driver'        => 'LocalFileSystem', 
          'path'          => set_realpath('../uploads/'), 
          'URL'           => '/uploads/',
          'encoding' => 'GBK',
          'uploadDeny'    => array('all'), 
          'uploadAllow'   => array('image', 'text/plain'),
          'uploadOrder'   => array('deny', 'allow'), 
          'accessControl' => 'access'
        ) 
      )
    );
    $this->load->library('elFinderUpload', $opts);
  }
}