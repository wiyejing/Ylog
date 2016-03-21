<?php
/**
 * 前台首页
 * @authors Jim Yeah (yejing@live.cn)
 * Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <title>叶靖个人空间 - 记录叶靖的学习生涯，写一些杂文随想，分享生活经历。——wiyejing.cn</title>
  <meta name="keywords" content="叶靖,emlog,影视欣赏，生活点滴,技术分享" />
  <meta name="description" content="叶靖个人空间，作者是叶靖，英文名leo，用emlog博客程序建的个人博客网站。叶靖个人空间记录叶靖的学习生涯，写一些杂文随想、技术文章，分享叶靖的一些生活点滴，又会有部分日记晒出来，偶尔写几篇影视欣赏。" />
  <meta name="generator" content="emlog" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no"/>
  <link rel="shortcut icon" href="http://space.wiyejing.cn/favicon.ico"/>
  <!-- <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://space.wiyejing.cn/xmlrpc.php?rsd" /> -->
  <!-- <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://space.wiyejing.cn/wlwmanifest.xml" /> -->
  <!-- <link rel="alternate" type="application/rss+xml" title="RSS"  href="http://space.wiyejing.cn/rss.php" /> -->
  <link rel="stylesheet" type="text/css" href="public/css/lina.css"/>
  <script type="text/javascript" src="public/js/jquery-1.7.1.js"></script>
  <script type="text/javascript" src="public/js/common_tpl.js"></script>
  <!--[if lt IE 9]>
  <script src="public/js/html5shiv.min.js"></script>
  <script src="public/js/respond.min.js"></script>
  <![endif]-->
    <!-- 自定义样式 -->
  <style type="text/css">
  #calendar .day a{color:red}  </style>
  <!-- 自定义样式 end-->
    </head>
<body>
  <!-- header start-->
  <header id="header">
    <div class="container">
      <div class="navbar" role="navigation">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button">
            <span class="sr-only">下拉菜单</span>
            <span class="icon-bar"></span>
          </button>
          <a title="返回首页" class="navbar-brand" href="http://space.wiyejing.cn/"  data-placement="left"><img alt="首页" src="http://space.wiyejing.cn/content/templates/LiNa/images/logo.png"></a>
        </div>
        <nav id="navbar">
          <ul class="nav navbar-left">
          <li class="active">
  <a href="http://space.wiyejing.cn/"  >首页 </a>
</li>
<li class="">
  <a href="http://space.wiyejing.cn/t"  >微语 </a>
</li>
<li class="">
  <a href="http://gallery.wiyejing.cn" target="_blank" >相册 </a>
</li>
<li class="">
  <a href="http://space.wiyejing.cn/guestbook.html"  >留言板 </a>
</li>
<li class="dropdown">
  <a href="#"  class="dropdown-toggle" >小游戏 <b class="caret"> </b></a>
  <ul class="dropdown-menu">
  <li><a href="http://space.wiyejing.cn/2048/" target="_blank" >2048</a></li>

<li><a href="http://space.wiyejing.cn/cat/" target="_blank" >神经猫</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="http://space.wiyejing.cn"  class="dropdown-toggle" >其他 <b class="caret"> </b></a>
  <ul class="dropdown-menu">
  <li><a href="http://tool.wiyejing.cn" target="_blank" >站长工具</a></li>
<li><a href="http://space.wiyejing.cn/links.html"  >友情链接</a></li>
<li><a href="http://space.wiyejing.cn/about.html" target="_blank" >关于本站</a></li>
<li><a href="http://space.wiyejing.cn/archiver.html" target="_blank" >日志归档</a></li>
<li><a href="http://space.wiyejing.cn/weibo.html" target="_blank" >站长微博</a></li>
  </ul>
</li>
          </ul>
          <form class="navbar-form search" id="search" role="search" action="http://space.wiyejing.cn/">
            <div class="input-group">
              <input name="keyword" class="form-control" type="text" onfocus="this.value=''" value="请输入关键词" placeholder="请输入关键词">
              <span class="input-group-btn">
                <button class="btn" onclick="return checkform();" type="submit">搜索</button>
              </span>
            </div>
          </form>
          <ul class="nav navbar-right">
            <li class="search">
              <a href="javascript:;"><span class="glyphicon glyphicon-search"></span></a>
            </li>
            <li class="dropdown user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <span class="font">
                  用户中心 <b class="caret"></b>
                </span>
                <span class="glyphicon glyphicon-user"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="http://space.wiyejing.cn/admin/" target="_blank">管理中心</a></li>
                                <li><a href="http://space.wiyejing.cn/?action=setting" target="_blank" rel="nofollow">主题设置</a></li>
                                <li style="position:relative">
                  <a href="http://space.wiyejing.cn/admin/admin_log.php" title="2篇文章待审" >待审文章<span class="notice_number"> 2</span></a>
                </li>
                                <li style="position:relative">
                  <a href="http://space.wiyejing.cn/admin/admin_log.php?pid=draft" title="10篇草稿待编辑" >草稿箱<span class="notice_number"> 10 </span></a>
                </li>
                                <li>
                  <a href="http://space.wiyejing.cn/admin/write_log.php" >写文章</a>
                </li>
                <li style="position:relative">
                  <a href="http://space.wiyejing.cn/admin/comment.php" title="0条评论待审"> 评论 <span class="notice_number"> 0</span> </a>
                </li>
                <li> <a href="http://space.wiyejing.cn/admin/?action=logout">退出</a> </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <div id="dialogbg"></div>
    <div class="dialog" id="loginform">
      <div class="dialogtop">
        <a class="closebtn" href="javascript:;"></a>
      </div>
      <form id="editform" action="http://space.wiyejing.cn/admin/index.php?action=login" method="post">
        <p class="logmsg"></p>
        <ul class="editinfos">
          <li>
            <label> 用户名： <input name="user" class="ipt" id="user" required="" type="text"></label>
          </li>
          <li>
            <label> 密&nbsp;&nbsp;&nbsp;码： <input name="pw" class="ipt" id="pw" required="" type="password"></label>
          </li>
          <li>
            <label>
              <input name="ispersis" type="checkbox" value="1"> 记住我</label>
          </li>
          <li>
            <input class="loginbtn" type="submit" value="确认登录"></li>
        </ul>
      </form>
    </div>
  </header>
  <!-- header end-->
  <!-- content start -->
  <div id="content" class="container">    <div id="article" class="pull-left">
      <h3 class="title"><strong>最新发布</strong></h3>
          <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/works" class="label sorturl label-success" title="查看 个人作品 分类文章">个人作品<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/works/199.html" title="点击阅读：【emlog模板】LiNa主题发布及使用说明" >【emlog模板】LiNa主题发布及使用说明</a></strong><span class="attnum small" title="此文有 2 张图片">2</span></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2014-11-6</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/works/199.html" ><img src="http://space.wiyejing.cn/content/uploadfile/201411/thum-29fa1415278987.jpg" alt="【emlog模板】LiNa主题发布及使用说明的第一张图片" /></a>
      </p>
      <div class="note">
        LiNa主题从【emlog模板】LiNa付费主题发布计划到LiNa主题 emlog模板预发布 全新UI，多功能设计，到现在历时三个月，终于要和大家要发布了。为了做出一个让自己满意更让大家满意的模板，的确不容易。<span class="readmore"><a href="http://space.wiyejing.cn/works/199.html">阅读全文&gt;&gt;</a></span>     </div>
      <p class="loginfo">
        <span>阅读(6488)</span>
        <span>评论(62) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/emlog">emlog</a> <a href="http://space.wiyejing.cn/tag/%E4%BD%9C%E5%93%81">作品</a> <a href="http://space.wiyejing.cn/tag/emlog%E6%A8%A1%E6%9D%BF">emlog模板</a> <a href="http://space.wiyejing.cn/tag/LiNa">LiNa</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/emlog" class="label sorturl label-success" title="查看 emlog 分类文章">emlog<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/emlog/useragent-for-emlog.html" title="点击阅读：useragent插件 emlog评论者信息显示插件发布" >useragent插件 emlog评论者信息显示插件发布</a></strong><span class="attnum small" title="此文有 2 张图片">2</span></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2014-6-29</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/emlog/useragent-for-emlog.html" ><img src="http://space.wiyejing.cn/content/uploadfile/201407/88de1406187041.png" alt="useragent插件 emlog评论者信息显示插件发布的第一张图片" /></a>
      </p>
      <div class="note">
        这是我第一个自己的插件，useragent插件——emlog简洁版插件。自己感觉良好。在网上找了很久，找到了小松做的useragent，10年的，很多系统和浏览器不支持。而且感觉那个插件太臃肿。于是就像自己开发出一下了。<span class="readmore"><a href="http://space.wiyejing.cn/emlog/useragent-for-emlog.html">阅读全文&gt;&gt;</a></span>      </div>
      <p class="loginfo">
        <span>阅读(11689)</span>
        <span>评论(178) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/emlog%E6%8F%92%E4%BB%B6">emlog插件</a> <a href="http://space.wiyejing.cn/tag/useragent">useragent</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/skill" class="label sorturl label-success" title="查看 技术分享 分类文章">技术分享<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/skill/200.html" title="点击阅读：win8.1各版本多用户远程桌面(RDP)会话补丁" >win8.1各版本多用户远程桌面(RDP)会话补丁</a></strong><span class="attnum small" title="此文有 1 张图片">1</span></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2015-5-12</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/skill/200.html" ><img src="http://space.wiyejing.cn/content/uploadfile/201505/c30d1431226357.png" alt="win8.1各版本多用户远程桌面(RDP)会话补丁的第一张图片" /></a>
      </p>
      <div class="note">
        Windows 8 .1 （以及所有以前的 Windows 客户端操作系统版本） 允许只有一个并发用户会话。这意味着如果本地用户已经登录，则无法通过远程桌面连接。通常它不是一个问题在客户端计算机上，但在某些情况下，您可能希望同时登录的能力。<span class="readmore"><a href="http://space.wiyejing.cn/skill/200.html">阅读全文&gt;&gt;</a></span>      </div>
      <p class="loginfo">
        <span>阅读(4035)</span>
        <span>评论(2) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/win8">win8</a> <a href="http://space.wiyejing.cn/tag/%E4%B8%8B%E8%BD%BD">下载</a> <a href="http://space.wiyejing.cn/tag/%E8%B5%84%E6%BA%90">资源</a> <a href="http://space.wiyejing.cn/tag/%E8%A1%A5%E4%B8%81">补丁</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/skill" class="label sorturl label-success" title="查看 技术分享 分类文章">技术分享<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/skill/197.html" title="点击阅读：前端组件库大合集-必备收藏" >前端组件库大合集-必备收藏</a></strong></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2015-5-7</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/skill/197.html" ><img src="http://space.wiyejing.cn/content/templates/LiNa/images/random/tb1.jpg" alt="前端组件库大合集-必备收藏的第一张图片" /></a>
      </p>
      <div class="note">
        前端组件库，搭建web app常用的样式/组件等收集列表(移动优先)<span class="readmore"><a href="http://space.wiyejing.cn/skill/197.html">阅读全文&gt;&gt;</a></span>      </div>
      <p class="loginfo">
        <span>阅读(2080)</span>
        <span>评论(1) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/css">css</a> <a href="http://space.wiyejing.cn/tag/%E5%89%8D%E7%AB%AF">前端</a> <a href="http://space.wiyejing.cn/tag/JS">JS</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/php" class="label sorturl label-success" title="查看 php 分类文章">php<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/php/181.html" title="点击阅读：国外程序员收集整理的PHP资源大全" >国外程序员收集整理的PHP资源大全</a></strong></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2015-4-30</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/php/181.html" ><img src="http://space.wiyejing.cn/content/templates/LiNa/images/random/tb6.jpg" alt="国外程序员收集整理的PHP资源大全的第一张图片" /></a>
      </p>
      <div class="note">
        ziadoz在 Github发起维护的一个PHP资源列表，内容包括：库、框架、模板、安全、代码分析、日志、第三方库、配置工具、Web 工具、书籍、电子书、经典博文等等<span class="readmore"><a href="http://space.wiyejing.cn/php/181.html">阅读全文&gt;&gt;</a></span>     </div>
      <p class="loginfo">
        <span>阅读(921)</span>
        <span>评论(0) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/php">php</a> <a href="http://space.wiyejing.cn/tag/%E8%B5%84%E6%BA%90">资源</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/skill" class="label sorturl label-success" title="查看 技术分享 分类文章">技术分享<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/skill/204.html" title="点击阅读：7个你可能不认识的CSS单位" >7个你可能不认识的CSS单位</a></strong><span class="attnum small" title="此文有 3 张图片">3</span></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2014-11-21</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/skill/204.html" ><img src="http://space.wiyejing.cn/content/uploadfile/201411/thum-6e491416546316.png" alt="7个你可能不认识的CSS单位的第一张图片" /></a>
      </p>
      <div class="note">
        今儿，我就准备向大伙儿介绍一些你们之前可能很少见过CSS家伙们。他们每个都是度量的单位，类似pixel 和 em 这样的，但是很有可能你之前从来就没听过这些家伙们！就让我们一起来交个朋友吧~<span class="readmore"><a href="http://space.wiyejing.cn/skill/204.html">阅读全文&gt;&gt;</a></span>     </div>
      <p class="loginfo">
        <span>阅读(1507)</span>
        <span>评论(8) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/css">css</a> <a href="http://space.wiyejing.cn/tag/%E5%89%8D%E7%AB%AF">前端</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/nlp" class="label sorturl label-success" title="查看 NLP 分类文章">NLP<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/nlp/203.html" title="点击阅读：内感官能力提升办法" >内感官能力提升办法</a></strong></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2014-11-16</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/nlp/203.html" ><img src="http://space.wiyejing.cn/content/templates/LiNa/images/random/tb2.jpg" alt="内感官能力提升办法的第一张图片" /></a>
      </p>
      <div class="note">
        改变内视觉、内听觉、内感觉的经验元素，就能很快改变自己对人对事的态度，减轻压力，增加推动力，把人生引导向健康、积极的状态。<span class="readmore"><a href="http://space.wiyejing.cn/nlp/203.html">阅读全文&gt;&gt;</a></span>     </div>
      <p class="loginfo">
        <span>阅读(1557)</span>
        <span>评论(11) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/nlp">nlp</a> <a href="http://space.wiyejing.cn/tag/%E5%86%85%E6%84%9F%E5%AE%98">内感官</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/emlog" class="label sorturl label-success" title="查看 emlog 分类文章">emlog<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/emlog/202.html" title="点击阅读：emlog文章列表获取附件（图片）数量方法" >emlog文章列表获取附件（图片）数量方法</a></strong><span class="attnum small" title="此文有 2 张图片">2</span></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2014-11-16</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/emlog/202.html" ><img src="http://space.wiyejing.cn/content/uploadfile/201411/thum-6c621416143467.png" alt="emlog文章列表获取附件（图片）数量方法的第一张图片" /></a>
      </p>
      <div class="note">
        本方法实际获取的是文章附件的数量，而非只是图片的数量，如果你的文章含有文件附件，列表也会显示成图片数量。所以此方法最适合于文章图片特别多而且没有附件的博客。<span class="readmore"><a href="http://space.wiyejing.cn/emlog/202.html">阅读全文&gt;&gt;</a></span>      </div>
      <p class="loginfo">
        <span>阅读(1654)</span>
        <span>评论(0) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/emlog">emlog</a> <a href="http://space.wiyejing.cn/tag/emlog%E6%A8%A1%E6%9D%BF">emlog模板</a> <a href="http://space.wiyejing.cn/tag/%E6%95%99%E7%A8%8B">教程</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/grow" class="label sorturl label-success" title="查看 生活点滴 分类文章">生活点滴<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/grow/198.html" title="点击阅读：2014-11-2一小时骑车记" >2014-11-2一小时骑车记</a></strong><span class="attnum small" title="此文有 1 张图片">1</span></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2014-11-2</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/grow/198.html" ><img src="http://space.wiyejing.cn/content/uploadfile/201411/thum-f09b1414928178.png" alt="2014-11-2一小时骑车记的第一张图片" /></a>
      </p>
      <div class="note">
        今天下午围绕娄底骑自行车骑了一个小时，路程12Km。骑的时候真的挺累的，但是坐下来的时候那是满身轻松啊！<span class="readmore"><a href="http://space.wiyejing.cn/grow/198.html">阅读全文&gt;&gt;</a></span>     </div>
      <p class="loginfo">
        <span>阅读(1268)</span>
        <span>评论(7) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/%E5%A4%A7%E5%AD%A6">大学</a> <a href="http://space.wiyejing.cn/tag/%E8%87%AA%E8%A1%8C%E8%BD%A6%E8%B7%AF%E7%BA%BF%E5%9B%BE">自行车路线图</a> <a href="http://space.wiyejing.cn/tag/%E7%94%9F%E6%B4%BB">生活</a></span>
      </p>
    </article>
        <article class="loglist">
      <h2><a href="http://space.wiyejing.cn/sort/php" class="label sorturl label-success" title="查看 php 分类文章">php<i class="arrow"></i></a>
<strong><a href="http://space.wiyejing.cn/php/196.html" title="点击阅读：php正则表达式如何匹配非链接文字" >php正则表达式如何匹配非链接文字</a></strong></h2>
      <p class="post">
        <span class="text-muted"><a href="http://space.wiyejing.cn/author/1" title="欢迎访问，这是叶靖的个人博客|个人空间。请多多指教…… admin@wiyejing.cn">Leo</a></span>
        发布于<span class="time"> 2014-10-13</span>
      </p>
      <p class="focus">
        <a class="thumbnail" href="http://space.wiyejing.cn/php/196.html" ><img src="http://space.wiyejing.cn/content/templates/LiNa/images/random/tb11.jpg" alt="php正则表达式如何匹配非链接文字的第一张图片" /></a>
      </p>
      <div class="note">
        给文字添加链接，需要匹配文章中的非链接文字，即找出文章的不在链接中或图片中的文字。因为如果匹配到文字刚好在链接中， 那么就容易出现乱码。所以需要匹配非链接文字。<span class="readmore"><a href="http://space.wiyejing.cn/php/196.html">阅读全文&gt;&gt;</a></span>      </div>
      <p class="loginfo">
        <span>阅读(1577)</span>
        <span>评论(12) </span>
        <span>标签: <a href="http://space.wiyejing.cn/tag/php">php</a> <a href="http://space.wiyejing.cn/tag/%E9%9D%9E%E9%93%BE%E6%8E%A5%E6%96%87%E5%AD%97">非链接文字</a></span>
      </p>
    </article>
        <div id="pagenavi">
       <span>1</span>  <a href="http://space.wiyejing.cn/page/2">2</a>  <a href="http://space.wiyejing.cn/page/3">3</a>  <a href="http://space.wiyejing.cn/page/4">4</a>  <a href="http://space.wiyejing.cn/page/5">5</a>  <a href="http://space.wiyejing.cn/page/6">6</a>  <a href="http://space.wiyejing.cn/page/2" class="next">下一页</a>  <a href="http://space.wiyejing.cn/page/11">尾页</a> 共 11 页    </div>
    <div class="ad4">  </div>
  </div> <!-- article end -->
<aside id="aside" class="pull-right">
    <div class="widget">
  <h3 class="title"><strong>日志分类</strong></h3>
  <ul id="blogsort">
  <li><a href="http://space.wiyejing.cn/sort/skill">技术分享(11)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/emlog">emlog(11)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/windows">windows(3)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/php">php(5)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/film">影视欣赏(7)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/works">个人作品(8)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/grow">生活点滴(23)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/life">杂文随想(11)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/learning">学习生涯(20)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/nlp">NLP(1)</a></li>
  <li><a href="http://space.wiyejing.cn/sort/reprinted">网络转载(6)</a></li>
  </ul>
  <p class="clear"></p>
</div>
<div class="widget">
  <h3 class="title"><strong>赞助商</strong></h3>
  <div class="customwidget">
  <div id="baidu_2" style="overflow:hidden;margin-left: -15px"></div> </div>
</div>
<div class="widget">
  <h3 class="title"><strong>最新评论</strong></h3>
  <ul id="newcomment">
<li>
  <p class="pull-left"><img class="avatar" src="http://space.wiyejing.cn/content/templates/LiNa/images/avatar/e85a5e15b23b3026aeed28a20965463f.jpg" alt="themebetter"/></p>
  <p><strong>themebetter</strong> 于 2016-03-17 说：</p>
  <p><a href="http://space.wiyejing.cn/works/199.html#2031">看着不错，说明再细致点可能更好。</a></p>
</li>
<li>
  <p class="pull-left"><img class="avatar" src="http://space.wiyejing.cn/content/templates/LiNa/images/avatar/54172fc1104cfbc7ae7294c5dbddff3d.jpg" alt="陈小儒"/></p>
  <p><strong>陈小儒</strong> 于 2016-03-16 说：</p>
  <p><a href="http://space.wiyejing.cn/links.html#2030">申请友链，已加入贵站
名称：陈小儒云
地址：www.yun0.cc</a></p>
</li>
<li>
  <p class="pull-left"><img class="avatar" src="http://space.wiyejing.cn/content/templates/LiNa/images/avatar/d41d8cd98f00b204e9800998ecf8427e.jpg" alt="mhjl2006"/></p>
  <p><strong>mhjl2006</strong> 于 2016-02-28 说：</p>
  <p><a href="http://space.wiyejing.cn/emlog/useragent-for-emlog.html#1989">没有 等级呢？</a></p>
</li>
<li>
  <p class="pull-left"><img class="avatar" src="http://space.wiyejing.cn/content/templates/LiNa/images/avatar/d41d8cd98f00b204e9800998ecf8427e.jpg" alt="网虫小王"/></p>
  <p><strong>网虫小王</strong> 于 2016-02-24 说：</p>
  <p><a href="http://space.wiyejing.cn/links.html#1978">为什么用了QQ互联插件，获取不到QQ头像呀，！
博主能解决吗，

QQ 546042381</a></p>
</li>
<li>
  <p class="pull-left"><img class="avatar" src="http://space.wiyejing.cn/content/templates/LiNa/images/avatar/d41d8cd98f00b204e9800998ecf8427e.jpg" alt="QQ-  初夏"/></p>
  <p><strong>QQ-  初夏</strong> 于 2016-02-22 说：</p>
  <p><a href="http://space.wiyejing.cn/emlog/useragent-for-emlog.html#1963">博主，你这个QQ登陆插件是不是修改过， 我安装上 -+-</a></p>
</li>
  </ul>
</div>
<div class="widget">
  <h3 class="title"><strong>标签</strong></h3>
  <ul id="blogtags">
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E5%85%BC%E8%81%8C" title="13 篇文章" target="_blank">兼职 +13</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E6%95%99%E7%A8%8B" title="10 篇文章" target="_blank">教程 +10</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/emlog" title="10 篇文章" target="_blank">emlog +10</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/emlog%E6%A8%A1%E6%9D%BF" title="10 篇文章" target="_blank">emlog模板 +10</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E8%80%83%E7%A0%94" title="7 篇文章" target="_blank">考研 +7</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/php" title="7 篇文章" target="_blank">php +7</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E4%BD%9C%E5%93%81" title="6 篇文章" target="_blank">作品 +6</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E6%97%A5%E8%AE%B0" title="6 篇文章" target="_blank">日记 +6</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E4%B8%8B%E8%BD%BD" title="5 篇文章" target="_blank">下载 +5</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E5%8D%9A%E5%AE%A2" title="5 篇文章" target="_blank">博客 +5</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E5%A4%A7%E5%AD%A6" title="4 篇文章" target="_blank">大学 +4</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E6%8C%91%E6%88%98%E6%9D%AF" title="4 篇文章" target="_blank">挑战杯 +4</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E7%BB%BC%E8%89%BA%E8%8A%82%E7%9B%AE" title="3 篇文章" target="_blank">综艺节目 +3</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E8%8B%B1%E8%AF%AD%E5%85%AD%E7%BA%A7" title="3 篇文章" target="_blank">英语六级 +3</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/emlog%E6%8F%92%E4%BB%B6" title="3 篇文章" target="_blank">emlog插件 +3</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/win8" title="3 篇文章" target="_blank">win8 +3</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E4%B8%93%E5%88%A9" title="2 篇文章" target="_blank">专利 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E5%88%B7%E6%9C%BA" title="2 篇文章" target="_blank">刷机 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E5%89%8D%E7%AB%AF" title="2 篇文章" target="_blank">前端 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E5%9B%BD%E5%BA%86%E8%8A%82" title="2 篇文章" target="_blank">国庆节 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E6%89%8B%E6%9C%BA" title="2 篇文章" target="_blank">手机 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E6%8A%80%E6%9C%AF" title="2 篇文章" target="_blank">技术 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E7%88%B8%E7%88%B8%E5%8E%BB%E5%93%AA%E5%84%BF" title="2 篇文章" target="_blank">爸爸去哪儿 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E7%94%B5%E5%BD%B1" title="2 篇文章" target="_blank">电影 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E7%94%B5%E8%A7%86%E5%89%A7" title="2 篇文章" target="_blank">电视剧 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E7%AB%9E%E8%B5%9B" title="2 篇文章" target="_blank">竞赛 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E8%AE%BA%E6%96%87" title="2 篇文章" target="_blank">论文 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/%E8%B5%84%E6%BA%90" title="2 篇文章" target="_blank">资源 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/2013" title="2 篇文章" target="_blank">2013 +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/LiNa" title="2 篇文章" target="_blank">LiNa +2</a></li>
  <li class="tags"><a class="label" href="http://space.wiyejing.cn/tag/css" title="2 篇文章" target="_blank">css +2</a></li>
  </ul>
  <p class="clear"></p>
</div>
<div class="widget">
  <h3 class="title"><strong>友情链接</strong></h3>
  <ul id="link">
  <li><a href="http://space.wiyejing.cn/links.html" title="友链申请说明" target="_blank">申请友链+</a></li>
  <li><a href="http://www.wiyejing.cn" title="叶靖的个人网站" target="_blank">叶靖|个人网站</a></li>
  <li><a href="http://p.youfu.org" title="" target="_blank">有福的鱼</a></li>
  <li><a href="http://www.janecc.com" title="简CC的个人博客" target="_blank">简CC的博客</a></li>
  <li><a href="http://blog.wiyejing.cn" title="叶靖的博客 作者是leo" target="_blank">狮子座的忧伤</a></li>
  <li><a href="http://www.xiaowu8.net/" title="紛紛萬事，直道而行！" target="_blank">小武哥的会展空间</a></li>
  <li><a href="http://www.shiyinqi.com/" title="" target="_blank">Shiyinqi.com/拾音器</a></li>
  <li><a href="http://www.feizhimeng.com" title="飞之梦技术笔记" target="_blank">飞之梦技术笔记</a></li>
  </ul>
  <p class="clear"></p>
</div>
  <div class="widget">
  <h3 class="title"><strong>站点统计</strong></h3>
  <ul id="sta">
<li>日志数量： 107</li><li>评论数量： 1141</li><li>碎语数量： 117</li><li>分类数量： 11</li><li>标签数量： 118</li><li>用户数量： 75</li><li>建站时间： 2013-10-09</li><li>运行时间： 893 天</li>  </ul>
</div>
  <div class="ad3 float">  </div>
</aside>
<!-- aside end -->    <p class="clear"></p>
  </div>
  <!-- content end -->
  <!-- footer start -->
  <footer id="footer">
    <div class="container">
      <p>
        &copy; 2016 Copyright All Rights Reserved.
      </p>
      <p>
        叶靖个人空间 版权所有 鄂ICP备15015564号      </p>
      <p>
        Powered by <a href="http://www.emlog.net/" target="_blank" title="采用emlog系统">emlog</a>&nbsp;
        Theme by <a href="http://space.wiyejing.cn/" target="_blank" title="由狮子座的忧伤设计">leo</a>&nbsp;
        <script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
<script type="text/javascript">
BAIDU_CLB_fillSlotAsync("u1587325","baidu_1");//文章内页
BAIDU_CLB_fillSlotAsync("u1563366","baidu_2");//侧边栏
var cpro_id = 'u1694064';
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/i.js"></script>        <style type="text/css">
/*会员信息*/
.useragent{padding-left:5px}
.vp,.vip,.vip1,.vip2,.vip3,.vip4,.vip5,.vip6,.vip7{background: url("http://space.wiyejing.cn/content/plugins/get_useragent/images/vip.png") no-repeat;display: inline-block;overflow: hidden;border: none;}
.vp{background-position:-494px -3px;width: 16px;height: 16px;margin-bottom: -3px;}
.vp:hover{
background-position:-491px -19px;width: 19px;height: 18px;margin-top: -3px;margin-left: -3px;margin-bottom: -3px;}
.vip{background-position:-515px -2px;width: 16px;height: 16px;margin-bottom: -3px;}
.vip:hover{background-position:-515px -22px;width: 16px;height: 16px;margin-bottom: -3px;}
.vip1{background-position:-1px -2px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip1:hover{background-position:-1px -22px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip2{background-position:-63px -2px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip2:hover{background-position:-63px -22px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip3{background-position:-144px -2px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip3:hover{background-position:-144px -22px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip4{background-position:-227px -2px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip4:hover{background-position:-227px -22px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip5{background-position:-331px -2px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip5:hover{background-position:-331px -22px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip6{background-position:-441px -2px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip6:hover{background-position:-441px -22px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip7{background-position:-611px -2px;width: 46px;height: 14px;margin-bottom: -1px;}
.vip7:hover{background-position:-611px -22px;width: 46px;height: 14px;margin-bottom: -1px;}
</style>
      </p>
    </div>
    <div class="shortcut">
      <div id="totop" title="返回顶部"></div>
      <div id="tobottom" title="查看底部"></div>
    </div>
  </footer>
  <!-- footer end -->
    <script type="text/javascript" src="http://space.wiyejing.cn/content/templates/LiNa/js/prettify.js"></script>
  <script type="text/javascript" src="http://space.wiyejing.cn/content/templates/LiNa/js/leo.js"></script>
  <script>
  sendinfo('http://space.wiyejing.cn/?action=cal','calendar');
  prettyPrint();
  if ($("a[data-lightbox='image_lg']").length >0) {
    document.write("<script type=\"text/javascript\" src=\"http://space.wiyejing.cn/content/templates/LiNa/js/lightbox.js\"><\/script>");
  };
  </script>
</body>
</html>
