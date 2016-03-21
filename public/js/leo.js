  // ctrl+Enter回复
$(document).keypress(function(e) {
    var com = $("textarea#comment").val();
    if (e.ctrlKey && e.which == 13 || e.which == 10) {
      if (com.length > 0) {
        $("#commentform").submit();
      }
    } else if (e.shiftKey && e.which == 13 || e.which == 10) {
      if (com.length > 0) {
        $("#commentform").submit();
      }
    }
  })
function checkform(){
  if($(".form-control").val() == ''){
    alert("关键词不能为空！");
    return false;
  }
}
function cktxtarea(){
  if ($("#comment").val() == '') {
    alert("评论内容不能为空！");
    return false;
  };
  if ($("#comname").val() == '') {
    alert("姓名不能为空！");
    return false;
  };  
}
  //加载完成后响应
$(function() {
  //移动端搜索居右
  if ($(document).width() < 768) {
    $(".navbar-left").addClass("navbar-collapse").removeClass("nav");
    $("#search").wrap('<div  class="dialog" id="searchform" />');
    $(".dialogtop").clone().prependTo("#searchform");
    $(".t5 tr").each(function(){
      $(this).children("td:eq(1)").width("80%");
      $(this).children("td:eq(2)").remove();
    })
  };  
  // h2正在加载
  $('.loglist h2 strong a').click(function(e) {
    e.preventDefault();
    var htm = '<span class="red">用尽吃奶的力气载入中…………</span>',
      t = $(this).html(htm).unbind('click');
    t.html(htm);
    window.location = this.href;
  });
  // 修改评论者信息
  $("#rename").click(function() {
    $("#cominfo").toggle();
  });
  // 缩略图渐显
  $('.thumbnail img').hover(
    function() {
      $(this).fadeTo("fast", 0.5);
    },
    function() {
      $(this).fadeTo("fast", 1);
    }
  );
  // 回到顶部
  $("#totop").click(function() {
    $("body,html").animate({
      scrollTop: 0
    }, 800);
  });
  // 到达底部
  $("#tobottom").click(function() {
    $("body,html").animate({
      scrollTop: $(document).height()
    }, 800);
  });
  // 文章内容图片
  $(".log .content a:not(:has(img))").not(".log_tags a").addClass("link");
  //显示弹框
  $('.login a').click(function() {
    $('#dialogbg').fadeIn(100, function() {
      $('#loginform').fadeIn();
    });
  });
  // 登录
  $('#editform').submit(function(e) {
    e.preventDefault();
    $.ajax({　　
      url: $('#editform').attr("action"),
      　　data: $('#editform').serialize(),
      　　type: "POST",
      　　success: function(d) {
        var pattern = /<div class="login-error">(.*?)<\/div>/;
        if (pattern.test(d)) {
          d = d.match(pattern);
          $(".logmsg").text(d[1]);
        } else {
          window.location.reload();
        }　　
      }
    });
  });
  //导航
  $(".nav > li").mouseover(function() {
    $(this).addClass("hover");
  });
  $(".nav > li").mouseout(function() {
    $(this).removeClass("hover");
  });
  // 导航收缩菜单
  $(".navbar-toggle").toggle(
    function() {
      $(".navbar-left").slideDown();
    },
    function() {
      $(".navbar-left").slideUp();
    }
  );
  // 移动端搜索
  $(".navbar-right .search").click(
    function() {
      $('#dialogbg').fadeIn(100, function() {
        $('#searchform').fadeIn();
      });
    }
  );
  //关闭弹窗
  $('.closebtn,#dialogbg').click(function() {
    $('.dialog').fadeOut(100, function() {
      $('#dialogbg').fadeOut();
    });
  });
  // 侧边栏悬浮
  $(".float").smartFloat();
  //real-avatar
  $("#commail").blur(function(){
    var avatar_url = 'http://en.gravatar.com/avatar/' + hex_md5(jQuery('#commail').val()) + '?s=64&d=identicon&r=g';
    jQuery('#realtime_avatar').attr('src', avatar_url);
    jQuery('#Get_Gravatar').fadeIn('slow');  
  })
  $(".content p").has("img").css("text-indent",0);
})

// ajax 评论
$(function() {
    jQuery('#commentform').submit(function(e) {
      e.preventDefault();
      var queryString = jQuery('#commentform').serialize(),
        url = jQuery('#commentform').attr('action');
      var id = jQuery('#comment-pid').val(),
        isChild = (id != '0'),
        comname = $.cookie("commentposter") ? $.cookie("commentposter") : $("input[name='comname']").val(),
        commail = $("input[name='commail']").val() ? $("input[name='commail']").val() : 'commail',
        firstcmt = '<h3 class="title"><strong>评论列表</strong><a name="comments"></a><small class="pull-right">(共1条评论)</small></h3>';
        commail = $.cookie("postermail") ? $.cookie("postermail") : commail;
        s = '<div class="comment comment-children"><header><div><img class="avatar" alt="avatar" src=http://en.gravatar.com/avatar/' + hex_md5(commail) + '?s=64&d=identicon&r=g /></div><p class="poster"><strong>' + comname + '</strong></p></header><p class="comment-content">' + $.trim($("#comment").val()) + '</p><footer class="comft"><p>刚刚发表……</p></article>';
        m = '<article class="comment"><header><div><img class="avatar" alt="avatar" src=http://en.gravatar.com/avatar/' + hex_md5(commail) + '?s=64&d=identicon&r=g /></div><p class="poster"><strong>' + comname + '</strong></p></header><p class="comment-content">' + $.trim($("#comment").val()) + '</p><footer class="comft"><p>刚刚发布……</p></article>';
      jQuery.ajax({
        type: 'POST',
        url: url,
        data: queryString,
        cache: false,
        beforeSend: function() {
          if ($("#comments h3").length < 1) {
            $("#comments").prepend(firstcmt);
          };  
          jQuery('#comment').attr('readonly', true);
          jQuery('#cmt-loading').html('努力提交中……').show();
          if (!$("input[name='comname']").val()) {

           if (isChild) {
             jQuery('#comment-' + id).append(s);
           } else {          
             jQuery('#comments h3').after(m);             
           }
          } else {
           if (isChild) {
             jQuery('#comment-' + id).append(s);
           } else {
             jQuery('#comments h3').after(m);             
           }
          }
          jQuery('#comment').val("");
        },
        success: function(d) {
          var pattern = /<div class="main">[\r\n]+<p>(.*?)<\/p>/;
          if (pattern.test(d)) {
            d = d.match(pattern);
            jQuery('#cmt-loading').html(d[1]);
            jQuery('#comment').focus();
            if (isChild) {
              // alert();
              jQuery('#comment-' + id).children().last().remove()
            } else{
              $("article.comment:first").remove();
            };
          } else {
            jQuery('#cmt-loading').html("评论成功!").delay("1000").fadeOut(600);
          }
          jQuery('#comment').removeAttr('readonly');
        }
      });
    });
  })

/*
        下面是插件
*/
// 百度分享
$(function() {
  window._bd_share_config = {
    "common": {
      "bdSnsKey": {},
      "bdText": "",
      "bdMini": "2",
      "bdMiniList": false,
      "bdPic": "",
      "bdStyle": "1",
      "bdSize": "32"
    },
    "share": {}
  };
  with(document) 0[(body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
});
//顶部悬浮小插件
$.fn.smartFloat = function() {
  var position = function(element) {
    var top = element.position().top,
      pos = element.css("position");
    $(window).scroll(function() {
      var scrolls = $(this).scrollTop();
      if (scrolls > top) {
        if (window.XMLHttpRequest) {
          element.css({
            position: "fixed",
            top: 55
          });
        } else {
          element.css({
            top: scrolls
          });
        }
      } else {
        element.css({
          position: pos,
          top: top
        });
      }
    });
  };
  return $(this).each(function() {
    position($(this));
  });
};
// jQuery.cookie插件
jQuery.cookie = function(name, value, options) {
  if (typeof value != 'undefined') {
    options = options || {};
    if (value === null) {
      value = '';
      options.expires = -1;
    }
    var expires = '';
    if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
      var date;
      if (typeof options.expires == 'number') {
        date = new Date();
        date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
      } else {
        date = options.expires;
      }
      expires = '; expires=' + date.toUTCString();
    }
    var path = options.path ? '; path=' + (options.path) : '';
    var domain = options.domain ? '; domain=' + (options.domain) : '';
    var secure = options.secure ? '; secure' : '';
    document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
  } else {
    var cookieValue = null;
    if (document.cookie && document.cookie != '') {
      var cookies = document.cookie.split(';');
      for (var i = 0; i < cookies.length; i++) {
        var cookie = jQuery.trim(cookies[i]);
        if (cookie.substring(0, name.length + 1) == (name + '=')) {
          cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
          break;
        }
      }
    }
    return cookieValue;
  }
};
  /* ========================================================================
   * Bootstrap: tooltip.js v3.3.0
   * http://getbootstrap.com/javascript/#tooltip
   * Inspired by the original jQuery.tipsy by Jason Frame
   * ========================================================================
   * Copyright 2011-2014 Twitter, Inc.
   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
   * ======================================================================== */
  + function($) {
    'use strict';
    // TOOLTIP PUBLIC CLASS DEFINITION
    // ===============================
    var Tooltip = function(element, options) {
      this.type =
        this.options =
        this.enabled =
        this.timeout =
        this.hoverState =
        this.$element = null
      this.init('tooltip', element, options)
    }
    Tooltip.VERSION = '3.3.0'
    Tooltip.TRANSITION_DURATION = 150
    Tooltip.DEFAULTS = {
      animation: true,
      placement: 'top',
      selector: false,
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
      trigger: 'hover focus',
      title: '',
      delay: 0,
      html: false,
      container: false,
      viewport: {
        selector: 'body',
        padding: 0
      }
    }
    Tooltip.prototype.init = function(type, element, options) {
      this.enabled = true
      this.type = type
      this.$element = $(element)
      this.options = this.getOptions(options)
      this.$viewport = this.options.viewport && $(this.options.viewport.selector || this.options.viewport)
      var triggers = this.options.trigger.split(' ')
      for (var i = triggers.length; i--;) {
        var trigger = triggers[i]
        if (trigger == 'click') {
          this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
        } else if (trigger != 'manual') {
          var eventIn = trigger == 'hover' ? 'mouseenter' : 'focusin'
          var eventOut = trigger == 'hover' ? 'mouseleave' : 'focusout'
          this.$element.on(eventIn + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
          this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
        }
      }
      this.options.selector ?
        (this._options = $.extend({}, this.options, {
          trigger: 'manual',
          selector: ''
        })) :
        this.fixTitle()
    }
    Tooltip.prototype.getDefaults = function() {
      return Tooltip.DEFAULTS
    }
    Tooltip.prototype.getOptions = function(options) {
      options = $.extend({}, this.getDefaults(), this.$element.data(), options)
      if (options.delay && typeof options.delay == 'number') {
        options.delay = {
          show: options.delay,
          hide: options.delay
        }
      }
      return options
    }
    Tooltip.prototype.getDelegateOptions = function() {
      var options = {}
      var defaults = this.getDefaults()
      this._options && $.each(this._options, function(key, value) {
        if (defaults[key] != value) options[key] = value
      })
      return options
    }
    Tooltip.prototype.enter = function(obj) {
      var self = obj instanceof this.constructor ?
        obj : $(obj.currentTarget).data('bs.' + this.type)
      if (self && self.$tip && self.$tip.is(':visible')) {
        self.hoverState = 'in'
        return
      }
      if (!self) {
        self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
        $(obj.currentTarget).data('bs.' + this.type, self)
      }
      clearTimeout(self.timeout)
      self.hoverState = 'in'
      if (!self.options.delay || !self.options.delay.show) return self.show()
      self.timeout = setTimeout(function() {
        if (self.hoverState == 'in') self.show()
      }, self.options.delay.show)
    }
    Tooltip.prototype.leave = function(obj) {
      var self = obj instanceof this.constructor ?
        obj : $(obj.currentTarget).data('bs.' + this.type)
      if (!self) {
        self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
        $(obj.currentTarget).data('bs.' + this.type, self)
      }
      clearTimeout(self.timeout)
      self.hoverState = 'out'
      if (!self.options.delay || !self.options.delay.hide) return self.hide()
      self.timeout = setTimeout(function() {
        if (self.hoverState == 'out') self.hide()
      }, self.options.delay.hide)
    }
    Tooltip.prototype.show = function() {
      var e = $.Event('show.bs.' + this.type)
      if (this.hasContent() && this.enabled) {
        this.$element.trigger(e)
        var inDom = $.contains(this.$element[0].ownerDocument.documentElement, this.$element[0])
        if (e.isDefaultPrevented() || !inDom) return
        var that = this
        var $tip = this.tip()
        var tipId = this.getUID(this.type)
        this.setContent()
        $tip.attr('id', tipId)
        this.$element.attr('aria-describedby', tipId)
        if (this.options.animation) $tip.addClass('fade')
        var placement = typeof this.options.placement == 'function' ?
          this.options.placement.call(this, $tip[0], this.$element[0]) :
          this.options.placement
        var autoToken = /\s?auto?\s?/i
        var autoPlace = autoToken.test(placement)
        if (autoPlace) placement = placement.replace(autoToken, '') || 'top'
        $tip
          .detach()
          .css({
            top: 0,
            left: 0,
            display: 'block'
          })
          .addClass(placement)
          .data('bs.' + this.type, this)
        this.options.container ? $tip.appendTo(this.options.container) : $tip.insertAfter(this.$element)
        var pos = this.getPosition()
        var actualWidth = $tip[0].offsetWidth
        var actualHeight = $tip[0].offsetHeight
        if (autoPlace) {
          var orgPlacement = placement
          var $container = this.options.container ? $(this.options.container) : this.$element.parent()
          var containerDim = this.getPosition($container)
          placement = placement == 'bottom' && pos.bottom + actualHeight > containerDim.bottom ? 'top' :
            placement == 'top' && pos.top - actualHeight < containerDim.top ? 'bottom' :
            placement == 'right' && pos.right + actualWidth > containerDim.width ? 'left' :
            placement == 'left' && pos.left - actualWidth < containerDim.left ? 'right' :
            placement
          $tip
            .removeClass(orgPlacement)
            .addClass(placement)
        }
        var calculatedOffset = this.getCalculatedOffset(placement, pos, actualWidth, actualHeight)
        this.applyPlacement(calculatedOffset, placement)
        var complete = function() {
          var prevHoverState = that.hoverState
          that.$element.trigger('shown.bs.' + that.type)
          that.hoverState = null
          if (prevHoverState == 'out') that.leave(that)
        }
        $.support.transition && this.$tip.hasClass('fade') ?
          $tip
          .one('bsTransitionEnd', complete)
          .emulateTransitionEnd(Tooltip.TRANSITION_DURATION) :
          complete()
      }
    }
    Tooltip.prototype.applyPlacement = function(offset, placement) {
      var $tip = this.tip()
      var width = $tip[0].offsetWidth
      var height = $tip[0].offsetHeight
        // manually read margins because getBoundingClientRect includes difference
      var marginTop = parseInt($tip.css('margin-top'), 10)
      var marginLeft = parseInt($tip.css('margin-left'), 10)
        // we must check for NaN for ie 8/9
      if (isNaN(marginTop)) marginTop = 0
      if (isNaN(marginLeft)) marginLeft = 0
      offset.top = offset.top + marginTop
      offset.left = offset.left + marginLeft
        // $.fn.offset doesn't round pixel values
        // so we use setOffset directly with our own function B-0
      $.offset.setOffset($tip[0], $.extend({
        using: function(props) {
          $tip.css({
            top: Math.round(props.top),
            left: Math.round(props.left)
          })
        }
      }, offset), 0)
      $tip.addClass('in')
        // check to see if placing tip in new offset caused the tip to resize itself
      var actualWidth = $tip[0].offsetWidth
      var actualHeight = $tip[0].offsetHeight
      if (placement == 'top' && actualHeight != height) {
        offset.top = offset.top + height - actualHeight
      }
      var delta = this.getViewportAdjustedDelta(placement, offset, actualWidth, actualHeight)
      if (delta.left) offset.left += delta.left
      else offset.top += delta.top
      var isVertical = /top|bottom/.test(placement)
      var arrowDelta = isVertical ? delta.left * 2 - width + actualWidth : delta.top * 2 - height + actualHeight
      var arrowOffsetPosition = isVertical ? 'offsetWidth' : 'offsetHeight'
      $tip.offset(offset)
      this.replaceArrow(arrowDelta, $tip[0][arrowOffsetPosition], isVertical)
    }
    Tooltip.prototype.replaceArrow = function(delta, dimension, isHorizontal) {
      this.arrow()
        .css(isHorizontal ? 'left' : 'top', 50 * (1 - delta / dimension) + '%')
        .css(isHorizontal ? 'top' : 'left', '')
    }
    Tooltip.prototype.setContent = function() {
      var $tip = this.tip()
      var title = this.getTitle()
      $tip.find('.tooltip-inner')[this.options.html ? 'html' : 'text'](title)
      $tip.removeClass('fade in top bottom left right')
    }
    Tooltip.prototype.hide = function(callback) {
      var that = this
      var $tip = this.tip()
      var e = $.Event('hide.bs.' + this.type)

      function complete() {
        if (that.hoverState != 'in') $tip.detach()
        that.$element
          .removeAttr('aria-describedby')
          .trigger('hidden.bs.' + that.type)
        callback && callback()
      }
      this.$element.trigger(e)
      if (e.isDefaultPrevented()) return
      $tip.removeClass('in')
      $.support.transition && this.$tip.hasClass('fade') ?
        $tip
        .one('bsTransitionEnd', complete)
        .emulateTransitionEnd(Tooltip.TRANSITION_DURATION) :
        complete()
      this.hoverState = null
      return this
    }
    Tooltip.prototype.fixTitle = function() {
      var $e = this.$element
      if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
        $e.attr('data-original-title', $e.attr('title') || '').attr('title', '')
      }
    }
    Tooltip.prototype.hasContent = function() {
      return this.getTitle()
    }
    Tooltip.prototype.getPosition = function($element) {
      $element = $element || this.$element
      var el = $element[0]
      var isBody = el.tagName == 'BODY'
      var elRect = el.getBoundingClientRect()
      if (elRect.width == null) {
        // width and height are missing in IE8, so compute them manually; see https://github.com/twbs/bootstrap/issues/14093
        elRect = $.extend({}, elRect, {
          width: elRect.right - elRect.left,
          height: elRect.bottom - elRect.top
        })
      }
      var elOffset = isBody ? {
        top: 0,
        left: 0
      } : $element.offset()
      var scroll = {
        scroll: isBody ? document.documentElement.scrollTop || document.body.scrollTop : $element.scrollTop()
      }
      var outerDims = isBody ? {
        width: $(window).width(),
        height: $(window).height()
      } : null
      return $.extend({}, elRect, scroll, outerDims, elOffset)
    }
    Tooltip.prototype.getCalculatedOffset = function(placement, pos, actualWidth, actualHeight) {
      return placement == 'bottom' ? {
          top: pos.top + pos.height,
          left: pos.left + pos.width / 2 - actualWidth / 2
        } :
        placement == 'top' ? {
          top: pos.top - actualHeight,
          left: pos.left + pos.width / 2 - actualWidth / 2
        } :
        placement == 'left' ? {
          top: pos.top + pos.height / 2 - actualHeight / 2,
          left: pos.left - actualWidth
        } :
        /* placement == 'right' */
        {
          top: pos.top + pos.height / 2 - actualHeight / 2,
          left: pos.left + pos.width
        }
    }
    Tooltip.prototype.getViewportAdjustedDelta = function(placement, pos, actualWidth, actualHeight) {
      var delta = {
        top: 0,
        left: 0
      }
      if (!this.$viewport) return delta
      var viewportPadding = this.options.viewport && this.options.viewport.padding || 0
      var viewportDimensions = this.getPosition(this.$viewport)
      if (/right|left/.test(placement)) {
        var topEdgeOffset = pos.top - viewportPadding - viewportDimensions.scroll
        var bottomEdgeOffset = pos.top + viewportPadding - viewportDimensions.scroll + actualHeight
        if (topEdgeOffset < viewportDimensions.top) { // top overflow
          delta.top = viewportDimensions.top - topEdgeOffset
        } else if (bottomEdgeOffset > viewportDimensions.top + viewportDimensions.height) { // bottom overflow
          delta.top = viewportDimensions.top + viewportDimensions.height - bottomEdgeOffset
        }
      } else {
        var leftEdgeOffset = pos.left - viewportPadding
        var rightEdgeOffset = pos.left + viewportPadding + actualWidth
        if (leftEdgeOffset < viewportDimensions.left) { // left overflow
          delta.left = viewportDimensions.left - leftEdgeOffset
        } else if (rightEdgeOffset > viewportDimensions.width) { // right overflow
          delta.left = viewportDimensions.left + viewportDimensions.width - rightEdgeOffset
        }
      }
      return delta
    }
    Tooltip.prototype.getTitle = function() {
      var title
      var $e = this.$element
      var o = this.options
      title = $e.attr('data-original-title') || (typeof o.title == 'function' ? o.title.call($e[0]) : o.title)
      return title
    }
    Tooltip.prototype.getUID = function(prefix) {
      do prefix += ~~(Math.random() * 1000000)
      while (document.getElementById(prefix))
      return prefix
    }
    Tooltip.prototype.tip = function() {
      return (this.$tip = this.$tip || $(this.options.template))
    }
    Tooltip.prototype.arrow = function() {
      return (this.$arrow = this.$arrow || this.tip().find('.tooltip-arrow'))
    }
    Tooltip.prototype.enable = function() {
      this.enabled = true
    }
    Tooltip.prototype.disable = function() {
      this.enabled = false
    }
    Tooltip.prototype.toggleEnabled = function() {
      this.enabled = !this.enabled
    }
    Tooltip.prototype.toggle = function(e) {
      var self = this
      if (e) {
        self = $(e.currentTarget).data('bs.' + this.type)
        if (!self) {
          self = new this.constructor(e.currentTarget, this.getDelegateOptions())
          $(e.currentTarget).data('bs.' + this.type, self)
        }
      }
      self.tip().hasClass('in') ? self.leave(self) : self.enter(self)
    }
    Tooltip.prototype.destroy = function() {
        var that = this
        clearTimeout(this.timeout)
        this.hide(function() {
          that.$element.off('.' + that.type).removeData('bs.' + that.type)
        })
      }
      // TOOLTIP PLUGIN DEFINITION
      // =========================
    function Plugin(option) {
      return this.each(function() {
        var $this = $(this)
        var data = $this.data('bs.tooltip')
        var options = typeof option == 'object' && option
        var selector = options && options.selector
        if (!data && option == 'destroy') return
        if (selector) {
          if (!data) $this.data('bs.tooltip', (data = {}))
          if (!data[selector]) data[selector] = new Tooltip(this, options)
        } else {
          if (!data) $this.data('bs.tooltip', (data = new Tooltip(this, options)))
        }
        if (typeof option == 'string') data[option]()
      })
    }
    var old = $.fn.tooltip
    $.fn.tooltip = Plugin
    $.fn.tooltip.Constructor = Tooltip
      // TOOLTIP NO CONFLICT
      // ===================
    $.fn.tooltip.noConflict = function() {
      $.fn.tooltip = old
      return this
    }
  }(jQuery);
// 提示工具配置
$(function() {
  var options = {
    animation: true,
    trigger: 'hover',
    placement: 'auto bottom',
    delay: {
      show: 0,
      hide: 300
    }
  }
  $(".navbar-brand").tooltip(options); //返回首页
  $(".sorturl").tooltip(options); //首页分类
  $(".attnum").tooltip(options); //图片数量
  $(".readers-list a").tooltip(options); //读者墙
  $(".poster a").tooltip(options); //评论者
  $("#footer a").tooltip(options); //footer
  $('.useragent img,.useragent a').tooltip(); //插件图片
  $('.content img').tooltip(); //文章内容图片
});

/*
 * A JavaScript implementation of the RSA Data Security, Inc. MD5 Message
 * Digest Algorithm, as defined in RFC 1321.
 * Version 2.2 Copyright (C) Paul Johnston 1999 - 2009
 * Other contributors: Greg Holt, Andrew Kepert, Ydnar, Lostinet
 * Distributed under the BSD License
 * See http://pajhome.org.uk/crypt/md5 for more info.
*/
var hexcase=0;var b64pad="";function hex_md5(s){return rstr2hex(rstr_md5(str2rstr_utf8(s)));}function b64_md5(s){return rstr2b64(rstr_md5(str2rstr_utf8(s)));}function any_md5(s,e){return rstr2any(rstr_md5(str2rstr_utf8(s)),e);}function hex_hmac_md5(k,d){return rstr2hex(rstr_hmac_md5(str2rstr_utf8(k),str2rstr_utf8(d)));}function b64_hmac_md5(k,d){return rstr2b64(rstr_hmac_md5(str2rstr_utf8(k),str2rstr_utf8(d)));}function any_hmac_md5(k,d,e){return rstr2any(rstr_hmac_md5(str2rstr_utf8(k),str2rstr_utf8(d)),e);}function md5_vm_test(){return md5("abc").toLowerCase()=="900150983cd24fb0d6963f7d28e17f72";}function rstr_md5(s){return binl2rstr(binl_md5(rstr2binl(s),s.length*8));}function rstr_hmac_md5(key,data){var bkey=rstr2binl(key);if(bkey.length>16)bkey=binl_md5(bkey,key.length*8);var ipad=Array(16),opad=Array(16);for(var i=0;i<16;i++){ipad[i]=bkey[i]^0x36363636;opad[i]=bkey[i]^0x5C5C5C5C;}var hash=binl_md5(ipad.concat(rstr2binl(data)),512+data.length*8);return binl2rstr(binl_md5(opad.concat(hash),512+128));}function rstr2hex(input){try{hexcase}catch(e){hexcase=0;}var hex_tab=hexcase?"0123456789ABCDEF":"0123456789abcdef";var output="";var x;for(var i=0;i<input.length;i++){x=input.charCodeAt(i);output+=hex_tab.charAt((x>>>4)&0x0F)+hex_tab.charAt(x&0x0F);}return output;}function rstr2b64(input){try{b64pad}catch(e){b64pad='';}var tab="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";var output="";var len=input.length;for(var i=0;i<len;i+=3){var triplet=(input.charCodeAt(i)<<16)|(i+1<len?input.charCodeAt(i+1)<<8:0)|(i+2<len?input.charCodeAt(i+2):0);for(var j=0;j<4;j++){if(i*8+j*6>input.length*8)output+=b64pad;else output+=tab.charAt((triplet>>>6*(3-j))&0x3F);}}return output;}function rstr2any(input,encoding){var divisor=encoding.length;var i,j,q,x,quotient;var dividend=Array(Math.ceil(input.length/2));for(i=0;i<dividend.length;i++){dividend[i]=(input.charCodeAt(i*2)<<8)|input.charCodeAt(i*2+1);}var full_length=Math.ceil(input.length*8/(Math.log(encoding.length)/Math.log(2)));var remainders=Array(full_length);for(j=0;j<full_length;j++){quotient=Array();x=0;for(i=0;i<dividend.length;i++){x=(x<<16)+dividend[i];q=Math.floor(x/divisor);x-=q*divisor;if(quotient.length>0||q>0)quotient[quotient.length]=q;}remainders[j]=x;dividend=quotient;}var output="";for(i=remainders.length-1;i>=0;i--)output+=encoding.charAt(remainders[i]);return output;}function str2rstr_utf8(input){var output="";var i=-1;var x,y;while(++i<input.length){x=input.charCodeAt(i);y=i+1<input.length?input.charCodeAt(i+1):0;if(0xD800<=x&&x<=0xDBFF&&0xDC00<=y&&y<=0xDFFF){x=0x10000+((x&0x03FF)<<10)+(y&0x03FF);i++;}if(x<=0x7F)output+=String.fromCharCode(x);else if(x<=0x7FF)output+=String.fromCharCode(0xC0|((x>>>6)&0x1F),0x80|(x&0x3F));else if(x<=0xFFFF)output+=String.fromCharCode(0xE0|((x>>>12)&0x0F),0x80|((x>>>6)&0x3F),0x80|(x&0x3F));else if(x<=0x1FFFFF)output+=String.fromCharCode(0xF0|((x>>>18)&0x07),0x80|((x>>>12)&0x3F),0x80|((x>>>6)&0x3F),0x80|(x&0x3F));}return output;}function str2rstr_utf16le(input){var output="";for(var i=0;i<input.length;i++)output+=String.fromCharCode(input.charCodeAt(i)&0xFF,(input.charCodeAt(i)>>>8)&0xFF);return output;}function str2rstr_utf16be(input){var output="";for(var i=0;i<input.length;i++)output+=String.fromCharCode((input.charCodeAt(i)>>>8)&0xFF,input.charCodeAt(i)&0xFF);return output;}function rstr2binl(input){var output=Array(input.length>>2);for(var i=0;i<output.length;i++)output[i]=0;for(var i=0;i<input.length*8;i+=8)output[i>>5]|=(input.charCodeAt(i/8)&0xFF)<<(i%32);return output;}function binl2rstr(input){var output="";for(var i=0;i<input.length*32;i+=8)output+=String.fromCharCode((input[i>>5]>>>(i%32))&0xFF);return output;}function binl_md5(x,len){x[len>>5]|=0x80<<((len)%32);x[(((len+64)>>>9)<<4)+14]=len;var a=1732584193;var b=-271733879;var c=-1732584194;var d=271733878;for(var i=0;i<x.length;i+=16){var olda=a;var oldb=b;var oldc=c;var oldd=d;a=md5_ff(a,b,c,d,x[i+0],7,-680876936);d=md5_ff(d,a,b,c,x[i+1],12,-389564586);c=md5_ff(c,d,a,b,x[i+2],17,606105819);b=md5_ff(b,c,d,a,x[i+3],22,-1044525330);a=md5_ff(a,b,c,d,x[i+4],7,-176418897);d=md5_ff(d,a,b,c,x[i+5],12,1200080426);c=md5_ff(c,d,a,b,x[i+6],17,-1473231341);b=md5_ff(b,c,d,a,x[i+7],22,-45705983);a=md5_ff(a,b,c,d,x[i+8],7,1770035416);d=md5_ff(d,a,b,c,x[i+9],12,-1958414417);c=md5_ff(c,d,a,b,x[i+10],17,-42063);b=md5_ff(b,c,d,a,x[i+11],22,-1990404162);a=md5_ff(a,b,c,d,x[i+12],7,1804603682);d=md5_ff(d,a,b,c,x[i+13],12,-40341101);c=md5_ff(c,d,a,b,x[i+14],17,-1502002290);b=md5_ff(b,c,d,a,x[i+15],22,1236535329);a=md5_gg(a,b,c,d,x[i+1],5,-165796510);d=md5_gg(d,a,b,c,x[i+6],9,-1069501632);c=md5_gg(c,d,a,b,x[i+11],14,643717713);b=md5_gg(b,c,d,a,x[i+0],20,-373897302);a=md5_gg(a,b,c,d,x[i+5],5,-701558691);d=md5_gg(d,a,b,c,x[i+10],9,38016083);c=md5_gg(c,d,a,b,x[i+15],14,-660478335);b=md5_gg(b,c,d,a,x[i+4],20,-405537848);a=md5_gg(a,b,c,d,x[i+9],5,568446438);d=md5_gg(d,a,b,c,x[i+14],9,-1019803690);c=md5_gg(c,d,a,b,x[i+3],14,-187363961);b=md5_gg(b,c,d,a,x[i+8],20,1163531501);a=md5_gg(a,b,c,d,x[i+13],5,-1444681467);d=md5_gg(d,a,b,c,x[i+2],9,-51403784);c=md5_gg(c,d,a,b,x[i+7],14,1735328473);b=md5_gg(b,c,d,a,x[i+12],20,-1926607734);a=md5_hh(a,b,c,d,x[i+5],4,-378558);d=md5_hh(d,a,b,c,x[i+8],11,-2022574463);c=md5_hh(c,d,a,b,x[i+11],16,1839030562);b=md5_hh(b,c,d,a,x[i+14],23,-35309556);a=md5_hh(a,b,c,d,x[i+1],4,-1530992060);d=md5_hh(d,a,b,c,x[i+4],11,1272893353);c=md5_hh(c,d,a,b,x[i+7],16,-155497632);b=md5_hh(b,c,d,a,x[i+10],23,-1094730640);a=md5_hh(a,b,c,d,x[i+13],4,681279174);d=md5_hh(d,a,b,c,x[i+0],11,-358537222);c=md5_hh(c,d,a,b,x[i+3],16,-722521979);b=md5_hh(b,c,d,a,x[i+6],23,76029189);a=md5_hh(a,b,c,d,x[i+9],4,-640364487);d=md5_hh(d,a,b,c,x[i+12],11,-421815835);c=md5_hh(c,d,a,b,x[i+15],16,530742520);b=md5_hh(b,c,d,a,x[i+2],23,-995338651);a=md5_ii(a,b,c,d,x[i+0],6,-198630844);d=md5_ii(d,a,b,c,x[i+7],10,1126891415);c=md5_ii(c,d,a,b,x[i+14],15,-1416354905);b=md5_ii(b,c,d,a,x[i+5],21,-57434055);a=md5_ii(a,b,c,d,x[i+12],6,1700485571);d=md5_ii(d,a,b,c,x[i+3],10,-1894986606);c=md5_ii(c,d,a,b,x[i+10],15,-1051523);b=md5_ii(b,c,d,a,x[i+1],21,-2054922799);a=md5_ii(a,b,c,d,x[i+8],6,1873313359);d=md5_ii(d,a,b,c,x[i+15],10,-30611744);c=md5_ii(c,d,a,b,x[i+6],15,-1560198380);b=md5_ii(b,c,d,a,x[i+13],21,1309151649);a=md5_ii(a,b,c,d,x[i+4],6,-145523070);d=md5_ii(d,a,b,c,x[i+11],10,-1120210379);c=md5_ii(c,d,a,b,x[i+2],15,718787259);b=md5_ii(b,c,d,a,x[i+9],21,-343485551);a=safe_add(a,olda);b=safe_add(b,oldb);c=safe_add(c,oldc);d=safe_add(d,oldd);}return Array(a,b,c,d);}function md5_cmn(q,a,b,x,s,t){return safe_add(bit_rol(safe_add(safe_add(a,q),safe_add(x,t)),s),b);}function md5_ff(a,b,c,d,x,s,t){return md5_cmn((b&c)|((~b)&d),a,b,x,s,t);}function md5_gg(a,b,c,d,x,s,t){return md5_cmn((b&d)|(c&(~d)),a,b,x,s,t);}function md5_hh(a,b,c,d,x,s,t){return md5_cmn(b^c^d,a,b,x,s,t);}function md5_ii(a,b,c,d,x,s,t){return md5_cmn(c^(b|(~d)),a,b,x,s,t);}function safe_add(x,y){var lsw=(x&0xFFFF)+(y&0xFFFF);var msw=(x>>16)+(y>>16)+(lsw>>16);return(msw<<16)|(lsw&0xFFFF);}function bit_rol(num,cnt){return(num<<cnt)|(num>>>(32-cnt));}  