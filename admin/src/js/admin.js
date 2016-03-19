/**
 * 后台脚本
 * @authors Jim Yeah (yejing@live.cn)
 * @Copyright (c) 2015 http://www.iyejing.cn All rights reserved.
 */
/**
 * 新增tab
 * @param {string} title 标题
 * @param {string} url   链接
 * @param {bool} close 是否显示关闭tab按钮
 */
function addTab(title, url,close) {
  if ($('#tabs').tabs('exists', title)) {
    $('#tabs').tabs('select', title);
    updateTab('',url);
  } else {
    $('#tabs').tabs('add', {
      title: title,
      content: createFrame(url),
      closable: close || false
    });
  }
}
/**
 * 刷新指定index的tab  
 * @param  {int} i 索引
 * @return    更新tab内容
 */
function updateTab (i,url) {
  var tab = i ? $('#tabs').tabs('getTab', i) : $('#tabs').tabs('getSelected');
  var url = url || tab.find('iframe').attr('src');
  $('#tabs').tabs('update', {
    tab: tab,
    options: {
      content: createFrame(url)
    }
  });
  // tab.panel('refresh', url);
}
// 创建内容模块
function createFrame (url) {
  return '<div class="easyui-panel" style="padding:4px;" border="none" fit="true"><iframe scrolling="auto" frameborder="0"  src="' + url + '" style="width:100%;height:100%;"></iframe></div>';
}
$(function() {
  $('#nav_tree').tree({
    onClick: function(node) {
      // console.log(node.state);
      addTab('内容管理', node.attributes.url);
    }
  });
  $('#system_tree').tree({
    onClick: function(node) {
      if(node.attributes.url)
        addTab(node.text, decodeURIComponent(node.attributes.url),1);
    }
  });
  $('#config_tree').tree({
    onClick: function(node) {
      if(node.attributes.url)
        addTab(node.text, decodeURIComponent(node.attributes.url),1);
    }
  });
});