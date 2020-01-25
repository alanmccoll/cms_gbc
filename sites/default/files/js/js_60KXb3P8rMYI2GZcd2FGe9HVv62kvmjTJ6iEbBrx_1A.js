// https://civicrm.org/licensing
(function($) {

// Keep track of all header cells.
var cells = [];

// Attach to all headers.
$(document).ready(function() {
  $('table thead.sticky').each(function () {
    // Make all absolute positioned elements relative to the table.
    var height = $(this).parent('table').css('position', 'relative').height();
    
    // Find all header cells.
    $('th', this).each(function () {
      
      // Ensure each cell has an element in it.
      var html = $(this).html();
      if (html == ' ') {
	html = '&nbsp;';
      }
      if ($(this).children().size() == 0) {
	html = '<span>'+ html +'</span>';
      }
      
      // Clone and wrap cell contents in sticky wrapper that overlaps the cell's padding.
      $('<div class="sticky-header" style="position: fixed; display: none; top: 0px;">'+ html +'</div>').prependTo(this);
      var div = $('div.sticky-header', this).css({
	  'marginLeft': '-'+ $(this).css('paddingLeft'),
          'marginRight': '-'+ $(this).css('paddingRight'),
          'paddingLeft': $(this).css('paddingLeft'),
          'paddingTop': $(this).css('paddingTop'),
          'paddingRight': $(this).css('paddingRight'),
          'paddingBottom': $(this).css('paddingBottom')
	})[0];
      // Adjust width to fit cell and hide.
      
      //CRM-6467
      var length = $(this).width() - $(div).width();
      if ( length < 0 ) length = $(div).width() - $(this).width();
      $(div).css('paddingRight', parseInt($(div).css('paddingRight')) + length +'px');

      cells.push(div);
      
      // Get position.
      div.cell = this;
      div.table = $(this).parent('table')[0];
      div.stickyMax = height;
      div.stickyPosition = $(this).y();
    });
  });
});

// Track scrolling.
var scroll = function() {
  $(cells).each(function () {
    // Fetch scrolling position.
    var scroll = document.documentElement.scrollTop || document.body.scrollTop;
    var offset = scroll - this.stickyPosition - 4;
    if (offset > 0 && offset < this.stickyMax - 100) {
      $(this).css({display:'block'});
    }
    else {
      $(this).css('display', 'none');
    }
  });
};
$(window).scroll(scroll);
$(document.documentElement).scroll(scroll);

// Track resizing.
var resize = function () {
  $(cells).each(function () {
    // Get position.
    $(this).css({ 'position': 'relative', 'top': '0'});
    this.stickyPosition = $(this.cell).y();
    this.stickyMax = $(this.table).height();
  });
};
$(window).resize(resize);

// Track the element positions
$.fn.x = function(n) {
  var result = null;
  this.each(function() {
    var o = this;
    if (n === undefined) {
      var x = 0;
      if (o.offsetParent) {
	while (o.offsetParent) {
	  x += o.offsetLeft;
	  o = o.offsetParent;
	}
      }
      if (result === null) {
	result = x;
      } else {
	result = Math.min(result, x);
      }
    } else {
      o.style.left = n + 'px';
    }
  });
  return result;
};

$.fn.y = function(n) {
  var result = null;
  this.each(function() {
    var o = this;
    if (n === undefined) {
      var y = 0;
      if (o.offsetParent) {
	while (o.offsetParent) {
	  y += o.offsetTop;
	  o = o.offsetParent;
	}
      }
      if (result === null) {
	result = y;
      } else {
	result = Math.min(result, y);
      }
    } else {
      o.style.top = n + 'px';
    }
  });
  return result;
};

})(jQuery);
;
/* jQuery Notify UI Widget 1.5 by Eric Hynds
 * http://www.erichynds.com/jquery/a-jquery-ui-growl-ubuntu-notification-widget/
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
*/
(function(d){d.widget("ech.notify",{options:{speed:500,expires:5E3,stack:"below",custom:!1,queue:!1},_create:function(){var a=this;this.templates={};this.keys=[];this.element.addClass("ui-notify").children().addClass("ui-notify-message ui-notify-message-style").each(function(b){b=this.id||b;a.keys.push(b);a.templates[b]=d(this).removeAttr("id").wrap("<div></div>").parent().html()}).end().empty().show()},create:function(a,b,c){"object"===typeof a&&(c=b,b=a,a=null);a=this.templates[a||this.keys[0]];c&&c.custom&&(a=d(a).removeClass("ui-notify-message-style").wrap("<div></div>").parent().html());this.openNotifications=this.openNotifications||0;return(new d.ech.notify.instance(this))._create(b,d.extend({},this.options,c),a)}});d.extend(d.ech.notify,{instance:function(a){this.__super=a;this.isOpen=!1}});d.extend(d.ech.notify.instance.prototype,{_create:function(a,b,c){this.options=b;var e=this,c=c.replace(/#(?:\{|%7B)(.*?)(?:\}|%7D)/g,function(b,c){return c in a?a[c]:""}),c=this.element=d(c),f=c.find(".ui-notify-close");"function"===typeof this.options.click&&c.addClass("ui-notify-click").bind("click",function(a){e._trigger("click",a,e)});f.length&&f.bind("click",function(){e.close();return!1});this.__super.element.queue("notify",function(){e.open();"number"===typeof b.expires&&0<b.expires&&setTimeout(d.proxy(e.close,e),b.expires)});(!this.options.queue||this.__super.openNotifications<=this.options.queue-1)&&this.__super.element.dequeue("notify");return this},close:function(){var a=this.options.speed;this.element.fadeTo(a,0).slideUp(a,d.proxy(function(){this._trigger("close");this.isOpen=!1;this.element.remove();this.__super.openNotifications-=1;this.__super.element.dequeue("notify")},this));return this},open:function(){if(this.isOpen||!1===this._trigger("beforeopen"))return this;var a=this;this.__super.openNotifications+=1;this.element["above"===this.options.stack?"prependTo":"appendTo"](this.__super.element).css({display:"none",opacity:""}).fadeIn(this.options.speed,function(){a._trigger("open");a.isOpen=!0});return this},widget:function(){return this.element},_trigger:function(a,b,c){return this.__super._trigger.call(this,a,b,c)}})})(jQuery);
;
/*! SmartMenus jQuery Plugin - v1.1.0 - September 17, 2017
 * http://www.smartmenus.org/
 * Copyright Vasil Dinkov, Vadikom Web Ltd. http://vadikom.com; Licensed MIT */(function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof module&&"object"==typeof module.exports?module.exports=t(require("jquery")):t(jQuery)})(function($){function initMouseDetection(t){var e=".smartmenus_mouse";if(mouseDetectionEnabled||t)mouseDetectionEnabled&&t&&($(document).off(e),mouseDetectionEnabled=!1);else{var i=!0,s=null,o={mousemove:function(t){var e={x:t.pageX,y:t.pageY,timeStamp:(new Date).getTime()};if(s){var o=Math.abs(s.x-e.x),a=Math.abs(s.y-e.y);if((o>0||a>0)&&2>=o&&2>=a&&300>=e.timeStamp-s.timeStamp&&(mouse=!0,i)){var n=$(t.target).closest("a");n.is("a")&&$.each(menuTrees,function(){return $.contains(this.$root[0],n[0])?(this.itemEnter({currentTarget:n[0]}),!1):void 0}),i=!1}}s=e}};o[touchEvents?"touchstart":"pointerover pointermove pointerout MSPointerOver MSPointerMove MSPointerOut"]=function(t){isTouchEvent(t.originalEvent)&&(mouse=!1)},$(document).on(getEventsNS(o,e)),mouseDetectionEnabled=!0}}function isTouchEvent(t){return!/^(4|mouse)$/.test(t.pointerType)}function getEventsNS(t,e){e||(e="");var i={};for(var s in t)i[s.split(" ").join(e+" ")+e]=t[s];return i}var menuTrees=[],mouse=!1,touchEvents="ontouchstart"in window,mouseDetectionEnabled=!1,requestAnimationFrame=window.requestAnimationFrame||function(t){return setTimeout(t,1e3/60)},cancelAnimationFrame=window.cancelAnimationFrame||function(t){clearTimeout(t)},canAnimate=!!$.fn.animate;return $.SmartMenus=function(t,e){this.$root=$(t),this.opts=e,this.rootId="",this.accessIdPrefix="",this.$subArrow=null,this.activatedItems=[],this.visibleSubMenus=[],this.showTimeout=0,this.hideTimeout=0,this.scrollTimeout=0,this.clickActivated=!1,this.focusActivated=!1,this.zIndexInc=0,this.idInc=0,this.$firstLink=null,this.$firstSub=null,this.disabled=!1,this.$disableOverlay=null,this.$touchScrollingSub=null,this.cssTransforms3d="perspective"in t.style||"webkitPerspective"in t.style,this.wasCollapsible=!1,this.init()},$.extend($.SmartMenus,{hideAll:function(){$.each(menuTrees,function(){this.menuHideAll()})},destroy:function(){for(;menuTrees.length;)menuTrees[0].destroy();initMouseDetection(!0)},prototype:{init:function(t){var e=this;if(!t){menuTrees.push(this),this.rootId=((new Date).getTime()+Math.random()+"").replace(/\D/g,""),this.accessIdPrefix="sm-"+this.rootId+"-",this.$root.hasClass("sm-rtl")&&(this.opts.rightToLeftSubMenus=!0);var i=".smartmenus";this.$root.data("smartmenus",this).attr("data-smartmenus-id",this.rootId).dataSM("level",1).on(getEventsNS({"mouseover focusin":$.proxy(this.rootOver,this),"mouseout focusout":$.proxy(this.rootOut,this),keydown:$.proxy(this.rootKeyDown,this)},i)).on(getEventsNS({mouseenter:$.proxy(this.itemEnter,this),mouseleave:$.proxy(this.itemLeave,this),mousedown:$.proxy(this.itemDown,this),focus:$.proxy(this.itemFocus,this),blur:$.proxy(this.itemBlur,this),click:$.proxy(this.itemClick,this)},i),"a"),i+=this.rootId,this.opts.hideOnClick&&$(document).on(getEventsNS({touchstart:$.proxy(this.docTouchStart,this),touchmove:$.proxy(this.docTouchMove,this),touchend:$.proxy(this.docTouchEnd,this),click:$.proxy(this.docClick,this)},i)),$(window).on(getEventsNS({"resize orientationchange":$.proxy(this.winResize,this)},i)),this.opts.subIndicators&&(this.$subArrow=$("<span/>").addClass("sub-arrow"),this.opts.subIndicatorsText&&this.$subArrow.html(this.opts.subIndicatorsText)),initMouseDetection()}if(this.$firstSub=this.$root.find("ul").each(function(){e.menuInit($(this))}).eq(0),this.$firstLink=this.$root.find("a").eq(0),this.opts.markCurrentItem){var s=/(index|default)\.[^#\?\/]*/i,o=/#.*/,a=window.location.href.replace(s,""),n=a.replace(o,"");this.$root.find("a").each(function(){var t=this.href.replace(s,""),i=$(this);(t==a||t==n)&&(i.addClass("current"),e.opts.markCurrentTree&&i.parentsUntil("[data-smartmenus-id]","ul").each(function(){$(this).dataSM("parent-a").addClass("current")}))})}this.wasCollapsible=this.isCollapsible()},destroy:function(t){if(!t){var e=".smartmenus";this.$root.removeData("smartmenus").removeAttr("data-smartmenus-id").removeDataSM("level").off(e),e+=this.rootId,$(document).off(e),$(window).off(e),this.opts.subIndicators&&(this.$subArrow=null)}this.menuHideAll();var i=this;this.$root.find("ul").each(function(){var t=$(this);t.dataSM("scroll-arrows")&&t.dataSM("scroll-arrows").remove(),t.dataSM("shown-before")&&((i.opts.subMenusMinWidth||i.opts.subMenusMaxWidth)&&t.css({width:"",minWidth:"",maxWidth:""}).removeClass("sm-nowrap"),t.dataSM("scroll-arrows")&&t.dataSM("scroll-arrows").remove(),t.css({zIndex:"",top:"",left:"",marginLeft:"",marginTop:"",display:""})),0==(t.attr("id")||"").indexOf(i.accessIdPrefix)&&t.removeAttr("id")}).removeDataSM("in-mega").removeDataSM("shown-before").removeDataSM("scroll-arrows").removeDataSM("parent-a").removeDataSM("level").removeDataSM("beforefirstshowfired").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeAttr("aria-expanded"),this.$root.find("a.has-submenu").each(function(){var t=$(this);0==t.attr("id").indexOf(i.accessIdPrefix)&&t.removeAttr("id")}).removeClass("has-submenu").removeDataSM("sub").removeAttr("aria-haspopup").removeAttr("aria-controls").removeAttr("aria-expanded").closest("li").removeDataSM("sub"),this.opts.subIndicators&&this.$root.find("span.sub-arrow").remove(),this.opts.markCurrentItem&&this.$root.find("a.current").removeClass("current"),t||(this.$root=null,this.$firstLink=null,this.$firstSub=null,this.$disableOverlay&&(this.$disableOverlay.remove(),this.$disableOverlay=null),menuTrees.splice($.inArray(this,menuTrees),1))},disable:function(t){if(!this.disabled){if(this.menuHideAll(),!t&&!this.opts.isPopup&&this.$root.is(":visible")){var e=this.$root.offset();this.$disableOverlay=$('<div class="sm-jquery-disable-overlay"/>').css({position:"absolute",top:e.top,left:e.left,width:this.$root.outerWidth(),height:this.$root.outerHeight(),zIndex:this.getStartZIndex(!0),opacity:0}).appendTo(document.body)}this.disabled=!0}},docClick:function(t){return this.$touchScrollingSub?(this.$touchScrollingSub=null,void 0):((this.visibleSubMenus.length&&!$.contains(this.$root[0],t.target)||$(t.target).closest("a").length)&&this.menuHideAll(),void 0)},docTouchEnd:function(){if(this.lastTouch){if(!(!this.visibleSubMenus.length||void 0!==this.lastTouch.x2&&this.lastTouch.x1!=this.lastTouch.x2||void 0!==this.lastTouch.y2&&this.lastTouch.y1!=this.lastTouch.y2||this.lastTouch.target&&$.contains(this.$root[0],this.lastTouch.target))){this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0);var t=this;this.hideTimeout=setTimeout(function(){t.menuHideAll()},350)}this.lastTouch=null}},docTouchMove:function(t){if(this.lastTouch){var e=t.originalEvent.touches[0];this.lastTouch.x2=e.pageX,this.lastTouch.y2=e.pageY}},docTouchStart:function(t){var e=t.originalEvent.touches[0];this.lastTouch={x1:e.pageX,y1:e.pageY,target:e.target}},enable:function(){this.disabled&&(this.$disableOverlay&&(this.$disableOverlay.remove(),this.$disableOverlay=null),this.disabled=!1)},getClosestMenu:function(t){for(var e=$(t).closest("ul");e.dataSM("in-mega");)e=e.parent().closest("ul");return e[0]||null},getHeight:function(t){return this.getOffset(t,!0)},getOffset:function(t,e){var i;"none"==t.css("display")&&(i={position:t[0].style.position,visibility:t[0].style.visibility},t.css({position:"absolute",visibility:"hidden"}).show());var s=t[0].getBoundingClientRect&&t[0].getBoundingClientRect(),o=s&&(e?s.height||s.bottom-s.top:s.width||s.right-s.left);return o||0===o||(o=e?t[0].offsetHeight:t[0].offsetWidth),i&&t.hide().css(i),o},getStartZIndex:function(t){var e=parseInt(this[t?"$root":"$firstSub"].css("z-index"));return!t&&isNaN(e)&&(e=parseInt(this.$root.css("z-index"))),isNaN(e)?1:e},getTouchPoint:function(t){return t.touches&&t.touches[0]||t.changedTouches&&t.changedTouches[0]||t},getViewport:function(t){var e=t?"Height":"Width",i=document.documentElement["client"+e],s=window["inner"+e];return s&&(i=Math.min(i,s)),i},getViewportHeight:function(){return this.getViewport(!0)},getViewportWidth:function(){return this.getViewport()},getWidth:function(t){return this.getOffset(t)},handleEvents:function(){return!this.disabled&&this.isCSSOn()},handleItemEvents:function(t){return this.handleEvents()&&!this.isLinkInMegaMenu(t)},isCollapsible:function(){return"static"==this.$firstSub.css("position")},isCSSOn:function(){return"inline"!=this.$firstLink.css("display")},isFixed:function(){var t="fixed"==this.$root.css("position");return t||this.$root.parentsUntil("body").each(function(){return"fixed"==$(this).css("position")?(t=!0,!1):void 0}),t},isLinkInMegaMenu:function(t){return $(this.getClosestMenu(t[0])).hasClass("mega-menu")},isTouchMode:function(){return!mouse||this.opts.noMouseOver||this.isCollapsible()},itemActivate:function(t,e){var i=t.closest("ul"),s=i.dataSM("level");if(s>1&&(!this.activatedItems[s-2]||this.activatedItems[s-2][0]!=i.dataSM("parent-a")[0])){var o=this;$(i.parentsUntil("[data-smartmenus-id]","ul").get().reverse()).add(i).each(function(){o.itemActivate($(this).dataSM("parent-a"))})}if((!this.isCollapsible()||e)&&this.menuHideSubMenus(this.activatedItems[s-1]&&this.activatedItems[s-1][0]==t[0]?s:s-1),this.activatedItems[s-1]=t,this.$root.triggerHandler("activate.smapi",t[0])!==!1){var a=t.dataSM("sub");a&&(this.isTouchMode()||!this.opts.showOnClick||this.clickActivated)&&this.menuShow(a)}},itemBlur:function(t){var e=$(t.currentTarget);this.handleItemEvents(e)&&this.$root.triggerHandler("blur.smapi",e[0])},itemClick:function(t){var e=$(t.currentTarget);if(this.handleItemEvents(e)){if(this.$touchScrollingSub&&this.$touchScrollingSub[0]==e.closest("ul")[0])return this.$touchScrollingSub=null,t.stopPropagation(),!1;if(this.$root.triggerHandler("click.smapi",e[0])===!1)return!1;var i=$(t.target).is(".sub-arrow"),s=e.dataSM("sub"),o=s?2==s.dataSM("level"):!1,a=this.isCollapsible(),n=/toggle$/.test(this.opts.collapsibleBehavior),r=/link$/.test(this.opts.collapsibleBehavior),h=/^accordion/.test(this.opts.collapsibleBehavior);if(s&&!s.is(":visible")){if((!r||!a||i)&&(this.opts.showOnClick&&o&&(this.clickActivated=!0),this.itemActivate(e,h),s.is(":visible")))return this.focusActivated=!0,!1}else if(a&&(n||i))return this.itemActivate(e,h),this.menuHide(s),n&&(this.focusActivated=!1),!1;return this.opts.showOnClick&&o||e.hasClass("disabled")||this.$root.triggerHandler("select.smapi",e[0])===!1?!1:void 0}},itemDown:function(t){var e=$(t.currentTarget);this.handleItemEvents(e)&&e.dataSM("mousedown",!0)},itemEnter:function(t){var e=$(t.currentTarget);if(this.handleItemEvents(e)){if(!this.isTouchMode()){this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0);var i=this;this.showTimeout=setTimeout(function(){i.itemActivate(e)},this.opts.showOnClick&&1==e.closest("ul").dataSM("level")?1:this.opts.showTimeout)}this.$root.triggerHandler("mouseenter.smapi",e[0])}},itemFocus:function(t){var e=$(t.currentTarget);this.handleItemEvents(e)&&(!this.focusActivated||this.isTouchMode()&&e.dataSM("mousedown")||this.activatedItems.length&&this.activatedItems[this.activatedItems.length-1][0]==e[0]||this.itemActivate(e,!0),this.$root.triggerHandler("focus.smapi",e[0]))},itemLeave:function(t){var e=$(t.currentTarget);this.handleItemEvents(e)&&(this.isTouchMode()||(e[0].blur(),this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0)),e.removeDataSM("mousedown"),this.$root.triggerHandler("mouseleave.smapi",e[0]))},menuHide:function(t){if(this.$root.triggerHandler("beforehide.smapi",t[0])!==!1&&(canAnimate&&t.stop(!0,!0),"none"!=t.css("display"))){var e=function(){t.css("z-index","")};this.isCollapsible()?canAnimate&&this.opts.collapsibleHideFunction?this.opts.collapsibleHideFunction.call(this,t,e):t.hide(this.opts.collapsibleHideDuration,e):canAnimate&&this.opts.hideFunction?this.opts.hideFunction.call(this,t,e):t.hide(this.opts.hideDuration,e),t.dataSM("scroll")&&(this.menuScrollStop(t),t.css({"touch-action":"","-ms-touch-action":"","-webkit-transform":"",transform:""}).off(".smartmenus_scroll").removeDataSM("scroll").dataSM("scroll-arrows").hide()),t.dataSM("parent-a").removeClass("highlighted").attr("aria-expanded","false"),t.attr({"aria-expanded":"false","aria-hidden":"true"});var i=t.dataSM("level");this.activatedItems.splice(i-1,1),this.visibleSubMenus.splice($.inArray(t,this.visibleSubMenus),1),this.$root.triggerHandler("hide.smapi",t[0])}},menuHideAll:function(){this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0);for(var t=this.opts.isPopup?1:0,e=this.visibleSubMenus.length-1;e>=t;e--)this.menuHide(this.visibleSubMenus[e]);this.opts.isPopup&&(canAnimate&&this.$root.stop(!0,!0),this.$root.is(":visible")&&(canAnimate&&this.opts.hideFunction?this.opts.hideFunction.call(this,this.$root):this.$root.hide(this.opts.hideDuration))),this.activatedItems=[],this.visibleSubMenus=[],this.clickActivated=!1,this.focusActivated=!1,this.zIndexInc=0,this.$root.triggerHandler("hideAll.smapi")},menuHideSubMenus:function(t){for(var e=this.activatedItems.length-1;e>=t;e--){var i=this.activatedItems[e].dataSM("sub");i&&this.menuHide(i)}},menuInit:function(t){if(!t.dataSM("in-mega")){t.hasClass("mega-menu")&&t.find("ul").dataSM("in-mega",!0);for(var e=2,i=t[0];(i=i.parentNode.parentNode)!=this.$root[0];)e++;var s=t.prevAll("a").eq(-1);s.length||(s=t.prevAll().find("a").eq(-1)),s.addClass("has-submenu").dataSM("sub",t),t.dataSM("parent-a",s).dataSM("level",e).parent().dataSM("sub",t);var o=s.attr("id")||this.accessIdPrefix+ ++this.idInc,a=t.attr("id")||this.accessIdPrefix+ ++this.idInc;s.attr({id:o,"aria-haspopup":"true","aria-controls":a,"aria-expanded":"false"}),t.attr({id:a,role:"group","aria-hidden":"true","aria-labelledby":o,"aria-expanded":"false"}),this.opts.subIndicators&&s[this.opts.subIndicatorsPos](this.$subArrow.clone())}},menuPosition:function(t){var e,i,s=t.dataSM("parent-a"),o=s.closest("li"),a=o.parent(),n=t.dataSM("level"),r=this.getWidth(t),h=this.getHeight(t),u=s.offset(),l=u.left,c=u.top,d=this.getWidth(s),m=this.getHeight(s),p=$(window),f=p.scrollLeft(),v=p.scrollTop(),b=this.getViewportWidth(),S=this.getViewportHeight(),g=a.parent().is("[data-sm-horizontal-sub]")||2==n&&!a.hasClass("sm-vertical"),M=this.opts.rightToLeftSubMenus&&!o.is("[data-sm-reverse]")||!this.opts.rightToLeftSubMenus&&o.is("[data-sm-reverse]"),w=2==n?this.opts.mainMenuSubOffsetX:this.opts.subMenusSubOffsetX,T=2==n?this.opts.mainMenuSubOffsetY:this.opts.subMenusSubOffsetY;if(g?(e=M?d-r-w:w,i=this.opts.bottomToTopSubMenus?-h-T:m+T):(e=M?w-r:d-w,i=this.opts.bottomToTopSubMenus?m-T-h:T),this.opts.keepInViewport){var y=l+e,I=c+i;if(M&&f>y?e=g?f-y+e:d-w:!M&&y+r>f+b&&(e=g?f+b-r-y+e:w-r),g||(S>h&&I+h>v+S?i+=v+S-h-I:(h>=S||v>I)&&(i+=v-I)),g&&(I+h>v+S+.49||v>I)||!g&&h>S+.49){var x=this;t.dataSM("scroll-arrows")||t.dataSM("scroll-arrows",$([$('<span class="scroll-up"><span class="scroll-up-arrow"></span></span>')[0],$('<span class="scroll-down"><span class="scroll-down-arrow"></span></span>')[0]]).on({mouseenter:function(){t.dataSM("scroll").up=$(this).hasClass("scroll-up"),x.menuScroll(t)},mouseleave:function(e){x.menuScrollStop(t),x.menuScrollOut(t,e)},"mousewheel DOMMouseScroll":function(t){t.preventDefault()}}).insertAfter(t));var A=".smartmenus_scroll";if(t.dataSM("scroll",{y:this.cssTransforms3d?0:i-m,step:1,itemH:m,subH:h,arrowDownH:this.getHeight(t.dataSM("scroll-arrows").eq(1))}).on(getEventsNS({mouseover:function(e){x.menuScrollOver(t,e)},mouseout:function(e){x.menuScrollOut(t,e)},"mousewheel DOMMouseScroll":function(e){x.menuScrollMousewheel(t,e)}},A)).dataSM("scroll-arrows").css({top:"auto",left:"0",marginLeft:e+(parseInt(t.css("border-left-width"))||0),width:r-(parseInt(t.css("border-left-width"))||0)-(parseInt(t.css("border-right-width"))||0),zIndex:t.css("z-index")}).eq(g&&this.opts.bottomToTopSubMenus?0:1).show(),this.isFixed()){var C={};C[touchEvents?"touchstart touchmove touchend":"pointerdown pointermove pointerup MSPointerDown MSPointerMove MSPointerUp"]=function(e){x.menuScrollTouch(t,e)},t.css({"touch-action":"none","-ms-touch-action":"none"}).on(getEventsNS(C,A))}}}t.css({top:"auto",left:"0",marginLeft:e,marginTop:i-m})},menuScroll:function(t,e,i){var s,o=t.dataSM("scroll"),a=t.dataSM("scroll-arrows"),n=o.up?o.upEnd:o.downEnd;if(!e&&o.momentum){if(o.momentum*=.92,s=o.momentum,.5>s)return this.menuScrollStop(t),void 0}else s=i||(e||!this.opts.scrollAccelerate?this.opts.scrollStep:Math.floor(o.step));var r=t.dataSM("level");if(this.activatedItems[r-1]&&this.activatedItems[r-1].dataSM("sub")&&this.activatedItems[r-1].dataSM("sub").is(":visible")&&this.menuHideSubMenus(r-1),o.y=o.up&&o.y>=n||!o.up&&n>=o.y?o.y:Math.abs(n-o.y)>s?o.y+(o.up?s:-s):n,t.css(this.cssTransforms3d?{"-webkit-transform":"translate3d(0, "+o.y+"px, 0)",transform:"translate3d(0, "+o.y+"px, 0)"}:{marginTop:o.y}),mouse&&(o.up&&o.y>o.downEnd||!o.up&&o.y<o.upEnd)&&a.eq(o.up?1:0).show(),o.y==n)mouse&&a.eq(o.up?0:1).hide(),this.menuScrollStop(t);else if(!e){this.opts.scrollAccelerate&&o.step<this.opts.scrollStep&&(o.step+=.2);var h=this;this.scrollTimeout=requestAnimationFrame(function(){h.menuScroll(t)})}},menuScrollMousewheel:function(t,e){if(this.getClosestMenu(e.target)==t[0]){e=e.originalEvent;var i=(e.wheelDelta||-e.detail)>0;t.dataSM("scroll-arrows").eq(i?0:1).is(":visible")&&(t.dataSM("scroll").up=i,this.menuScroll(t,!0))}e.preventDefault()},menuScrollOut:function(t,e){mouse&&(/^scroll-(up|down)/.test((e.relatedTarget||"").className)||(t[0]==e.relatedTarget||$.contains(t[0],e.relatedTarget))&&this.getClosestMenu(e.relatedTarget)==t[0]||t.dataSM("scroll-arrows").css("visibility","hidden"))},menuScrollOver:function(t,e){if(mouse&&!/^scroll-(up|down)/.test(e.target.className)&&this.getClosestMenu(e.target)==t[0]){this.menuScrollRefreshData(t);var i=t.dataSM("scroll"),s=$(window).scrollTop()-t.dataSM("parent-a").offset().top-i.itemH;t.dataSM("scroll-arrows").eq(0).css("margin-top",s).end().eq(1).css("margin-top",s+this.getViewportHeight()-i.arrowDownH).end().css("visibility","visible")}},menuScrollRefreshData:function(t){var e=t.dataSM("scroll"),i=$(window).scrollTop()-t.dataSM("parent-a").offset().top-e.itemH;this.cssTransforms3d&&(i=-(parseFloat(t.css("margin-top"))-i)),$.extend(e,{upEnd:i,downEnd:i+this.getViewportHeight()-e.subH})},menuScrollStop:function(t){return this.scrollTimeout?(cancelAnimationFrame(this.scrollTimeout),this.scrollTimeout=0,t.dataSM("scroll").step=1,!0):void 0},menuScrollTouch:function(t,e){if(e=e.originalEvent,isTouchEvent(e)){var i=this.getTouchPoint(e);if(this.getClosestMenu(i.target)==t[0]){var s=t.dataSM("scroll");if(/(start|down)$/i.test(e.type))this.menuScrollStop(t)?(e.preventDefault(),this.$touchScrollingSub=t):this.$touchScrollingSub=null,this.menuScrollRefreshData(t),$.extend(s,{touchStartY:i.pageY,touchStartTime:e.timeStamp});else if(/move$/i.test(e.type)){var o=void 0!==s.touchY?s.touchY:s.touchStartY;if(void 0!==o&&o!=i.pageY){this.$touchScrollingSub=t;var a=i.pageY>o;void 0!==s.up&&s.up!=a&&$.extend(s,{touchStartY:i.pageY,touchStartTime:e.timeStamp}),$.extend(s,{up:a,touchY:i.pageY}),this.menuScroll(t,!0,Math.abs(i.pageY-o))}e.preventDefault()}else void 0!==s.touchY&&((s.momentum=15*Math.pow(Math.abs(i.pageY-s.touchStartY)/(e.timeStamp-s.touchStartTime),2))&&(this.menuScrollStop(t),this.menuScroll(t),e.preventDefault()),delete s.touchY)}}},menuShow:function(t){if((t.dataSM("beforefirstshowfired")||(t.dataSM("beforefirstshowfired",!0),this.$root.triggerHandler("beforefirstshow.smapi",t[0])!==!1))&&this.$root.triggerHandler("beforeshow.smapi",t[0])!==!1&&(t.dataSM("shown-before",!0),canAnimate&&t.stop(!0,!0),!t.is(":visible"))){var e=t.dataSM("parent-a"),i=this.isCollapsible();if((this.opts.keepHighlighted||i)&&e.addClass("highlighted"),i)t.removeClass("sm-nowrap").css({zIndex:"",width:"auto",minWidth:"",maxWidth:"",top:"",left:"",marginLeft:"",marginTop:""});else{if(t.css("z-index",this.zIndexInc=(this.zIndexInc||this.getStartZIndex())+1),(this.opts.subMenusMinWidth||this.opts.subMenusMaxWidth)&&(t.css({width:"auto",minWidth:"",maxWidth:""}).addClass("sm-nowrap"),this.opts.subMenusMinWidth&&t.css("min-width",this.opts.subMenusMinWidth),this.opts.subMenusMaxWidth)){var s=this.getWidth(t);t.css("max-width",this.opts.subMenusMaxWidth),s>this.getWidth(t)&&t.removeClass("sm-nowrap").css("width",this.opts.subMenusMaxWidth)}this.menuPosition(t)}var o=function(){t.css("overflow","")};i?canAnimate&&this.opts.collapsibleShowFunction?this.opts.collapsibleShowFunction.call(this,t,o):t.show(this.opts.collapsibleShowDuration,o):canAnimate&&this.opts.showFunction?this.opts.showFunction.call(this,t,o):t.show(this.opts.showDuration,o),e.attr("aria-expanded","true"),t.attr({"aria-expanded":"true","aria-hidden":"false"}),this.visibleSubMenus.push(t),this.$root.triggerHandler("show.smapi",t[0])}},popupHide:function(t){this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0);var e=this;this.hideTimeout=setTimeout(function(){e.menuHideAll()},t?1:this.opts.hideTimeout)},popupShow:function(t,e){if(!this.opts.isPopup)return alert('SmartMenus jQuery Error:\n\nIf you want to show this menu via the "popupShow" method, set the isPopup:true option.'),void 0;if(this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0),this.$root.dataSM("shown-before",!0),canAnimate&&this.$root.stop(!0,!0),!this.$root.is(":visible")){this.$root.css({left:t,top:e});var i=this,s=function(){i.$root.css("overflow","")};canAnimate&&this.opts.showFunction?this.opts.showFunction.call(this,this.$root,s):this.$root.show(this.opts.showDuration,s),this.visibleSubMenus[0]=this.$root}},refresh:function(){this.destroy(!0),this.init(!0)},rootKeyDown:function(t){if(this.handleEvents())switch(t.keyCode){case 27:var e=this.activatedItems[0];if(e){this.menuHideAll(),e[0].focus();var i=e.dataSM("sub");i&&this.menuHide(i)}break;case 32:var s=$(t.target);if(s.is("a")&&this.handleItemEvents(s)){var i=s.dataSM("sub");i&&!i.is(":visible")&&(this.itemClick({currentTarget:t.target}),t.preventDefault())}}},rootOut:function(t){if(this.handleEvents()&&!this.isTouchMode()&&t.target!=this.$root[0]&&(this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0),!this.opts.showOnClick||!this.opts.hideOnClick)){var e=this;this.hideTimeout=setTimeout(function(){e.menuHideAll()},this.opts.hideTimeout)}},rootOver:function(t){this.handleEvents()&&!this.isTouchMode()&&t.target!=this.$root[0]&&this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0)},winResize:function(t){if(this.handleEvents()){if(!("onorientationchange"in window)||"orientationchange"==t.type){var e=this.isCollapsible();this.wasCollapsible&&e||(this.activatedItems.length&&this.activatedItems[this.activatedItems.length-1][0].blur(),this.menuHideAll()),this.wasCollapsible=e}}else if(this.$disableOverlay){var i=this.$root.offset();this.$disableOverlay.css({top:i.top,left:i.left,width:this.$root.outerWidth(),height:this.$root.outerHeight()})}}}}),$.fn.dataSM=function(t,e){return e?this.data(t+"_smartmenus",e):this.data(t+"_smartmenus")},$.fn.removeDataSM=function(t){return this.removeData(t+"_smartmenus")},$.fn.smartmenus=function(options){if("string"==typeof options){var args=arguments,method=options;return Array.prototype.shift.call(args),this.each(function(){var t=$(this).data("smartmenus");t&&t[method]&&t[method].apply(t,args)})}return this.each(function(){var dataOpts=$(this).data("sm-options")||null;if(dataOpts)try{dataOpts=eval("("+dataOpts+")")}catch(e){dataOpts=null,alert('ERROR\n\nSmartMenus jQuery init:\nInvalid "data-sm-options" attribute value syntax.')}new $.SmartMenus(this,$.extend({},$.fn.smartmenus.defaults,options,dataOpts))})},$.fn.smartmenus.defaults={isPopup:!1,mainMenuSubOffsetX:0,mainMenuSubOffsetY:0,subMenusSubOffsetX:0,subMenusSubOffsetY:0,subMenusMinWidth:"10em",subMenusMaxWidth:"20em",subIndicators:!0,subIndicatorsPos:"append",subIndicatorsText:"",scrollStep:30,scrollAccelerate:!0,showTimeout:250,hideTimeout:500,showDuration:0,showFunction:null,hideDuration:0,hideFunction:function(t,e){t.fadeOut(200,e)},collapsibleShowDuration:0,collapsibleShowFunction:function(t,e){t.slideDown(200,e)},collapsibleHideDuration:0,collapsibleHideFunction:function(t,e){t.slideUp(200,e)},showOnClick:!1,hideOnClick:!0,noMouseOver:!1,keepInViewport:!0,keepHighlighted:!0,markCurrentItem:!1,markCurrentTree:!0,rightToLeftSubMenus:!1,bottomToTopSubMenus:!1,collapsibleBehavior:"default"},$});;
/*! SmartMenus jQuery Plugin Keyboard Addon - v0.4.0 - September 17, 2017
 * http://www.smartmenus.org/
 * Copyright Vasil Dinkov, Vadikom Web Ltd. http://vadikom.com; Licensed MIT */(function(t){"function"==typeof define&&define.amd?define(["jquery","smartmenus"],t):"object"==typeof module&&"object"==typeof module.exports?module.exports=t(require("jquery")):t(jQuery)})(function(t){function e(t){return t.find("> li > a:not(.disabled), > li > :not(ul) a:not(.disabled)").eq(0)}function s(t){return t.find("> li > a:not(.disabled), > li > :not(ul) a:not(.disabled)").eq(-1)}function i(t,s){var i=t.nextAll("li").find("> a:not(.disabled), > :not(ul) a:not(.disabled)").eq(0);return s||i.length?i:e(t.parent())}function o(e,i){var o=e.prevAll("li").find("> a:not(.disabled), > :not(ul) a:not(.disabled)").eq(/^1\.8\./.test(t.fn.jquery)?0:-1);return i||o.length?o:s(e.parent())}return t.fn.focusSM=function(){return this.length&&this[0].focus&&this[0].focus(),this},t.extend(t.SmartMenus.Keyboard={},{docKeydown:function(a){var n=a.keyCode;if(/^(37|38|39|40)$/.test(n)){var r=t(this),u=r.data("smartmenus"),h=t(a.target);if(u&&h.is("a")&&u.handleItemEvents(h)){var l=h.closest("li"),c=l.parent(),d=c.dataSM("level");switch(r.hasClass("sm-rtl")&&(37==n?n=39:39==n&&(n=37)),n){case 37:if(u.isCollapsible())break;d>2||2==d&&r.hasClass("sm-vertical")?u.activatedItems[d-2].focusSM():r.hasClass("sm-vertical")||o((u.activatedItems[0]||h).closest("li")).focusSM();break;case 38:if(u.isCollapsible()){var m;d>1&&(m=e(c)).length&&h[0]==m[0]?u.activatedItems[d-2].focusSM():o(l).focusSM()}else 1==d&&!r.hasClass("sm-vertical")&&u.opts.bottomToTopSubMenus?(!u.activatedItems[0]&&h.dataSM("sub")&&(u.opts.showOnClick&&(u.clickActivated=!0),u.itemActivate(h),h.dataSM("sub").is(":visible")&&(u.focusActivated=!0)),u.activatedItems[0]&&u.activatedItems[0].dataSM("sub")&&u.activatedItems[0].dataSM("sub").is(":visible")&&!u.activatedItems[0].dataSM("sub").hasClass("mega-menu")&&s(u.activatedItems[0].dataSM("sub")).focusSM()):(d>1||r.hasClass("sm-vertical"))&&o(l).focusSM();break;case 39:if(u.isCollapsible())break;1==d&&r.hasClass("sm-vertical")?(!u.activatedItems[0]&&h.dataSM("sub")&&(u.opts.showOnClick&&(u.clickActivated=!0),u.itemActivate(h),h.dataSM("sub").is(":visible")&&(u.focusActivated=!0)),u.activatedItems[0]&&u.activatedItems[0].dataSM("sub")&&u.activatedItems[0].dataSM("sub").is(":visible")&&!u.activatedItems[0].dataSM("sub").hasClass("mega-menu")&&e(u.activatedItems[0].dataSM("sub")).focusSM()):1!=d&&(!u.activatedItems[d-1]||u.activatedItems[d-1].dataSM("sub")&&u.activatedItems[d-1].dataSM("sub").is(":visible")&&!u.activatedItems[d-1].dataSM("sub").hasClass("mega-menu"))||r.hasClass("sm-vertical")?u.activatedItems[d-1]&&u.activatedItems[d-1].dataSM("sub")&&u.activatedItems[d-1].dataSM("sub").is(":visible")&&!u.activatedItems[d-1].dataSM("sub").hasClass("mega-menu")&&e(u.activatedItems[d-1].dataSM("sub")).focusSM():i((u.activatedItems[0]||h).closest("li")).focusSM();break;case 40:if(u.isCollapsible()){var p,f;if(u.activatedItems[d-1]&&u.activatedItems[d-1].dataSM("sub")&&u.activatedItems[d-1].dataSM("sub").is(":visible")&&!u.activatedItems[d-1].dataSM("sub").hasClass("mega-menu")&&(p=e(u.activatedItems[d-1].dataSM("sub"))).length)p.focusSM();else if(d>1&&(f=s(c)).length&&h[0]==f[0]){for(var v=u.activatedItems[d-2].closest("li"),b=null;v.is("li")&&!(b=i(v,!0)).length;)v=v.parent().parent();b.length?b.focusSM():e(r).focusSM()}else i(l).focusSM()}else 1!=d||r.hasClass("sm-vertical")||u.opts.bottomToTopSubMenus?(d>1||r.hasClass("sm-vertical"))&&i(l).focusSM():(!u.activatedItems[0]&&h.dataSM("sub")&&(u.opts.showOnClick&&(u.clickActivated=!0),u.itemActivate(h),h.dataSM("sub").is(":visible")&&(u.focusActivated=!0)),u.activatedItems[0]&&u.activatedItems[0].dataSM("sub")&&u.activatedItems[0].dataSM("sub").is(":visible")&&!u.activatedItems[0].dataSM("sub").hasClass("mega-menu")&&e(u.activatedItems[0].dataSM("sub")).focusSM())}a.stopPropagation(),a.preventDefault()}}}}),t(document).on("keydown.smartmenus","ul.sm, ul.navbar-nav:not([data-sm-skip])",t.SmartMenus.Keyboard.docKeydown),t.extend(t.SmartMenus.prototype,{keyboardSetHotkey:function(s,i){var o=this;t(document).on("keydown.smartmenus"+this.rootId,function(a){if(s==a.keyCode){var n=!0;i&&("string"==typeof i&&(i=[i]),t.each(["ctrlKey","shiftKey","altKey","metaKey"],function(e,s){return t.inArray(s,i)>=0&&!a[s]||0>t.inArray(s,i)&&a[s]?(n=!1,!1):void 0})),n&&(e(o.$root).focusSM(),a.stopPropagation(),a.preventDefault())}})}}),t});;
// https://civicrm.org/licensing
(function($, _) {
  "use strict";
  var templates, initialized,
    ENTER_KEY = 13,
    SPACE_KEY = 32;
  CRM.menubar = _.extend({
    data: null,
    settings: {collapsibleBehavior: 'accordion'},
    position: 'over-cms-menu',
    attachTo: (CRM.menubar && CRM.menubar.position === 'above-crm-container') ? '#crm-container' : 'body',
    initialize: function() {
      var cache = CRM.cache.get('menubar');
      if (cache && cache.code === CRM.menubar.cacheCode && cache.locale === CRM.config.locale && cache.cid === CRM.config.cid && localStorage.civiMenubar) {
        CRM.menubar.data = cache.data;
        insert(localStorage.civiMenubar);
      } else {
        $.getJSON(CRM.url('civicrm/ajax/navmenu', {code: CRM.menubar.cacheCode, locale: CRM.config.locale, cid: CRM.config.cid}))
          .done(function(data) {
            var markup = getTpl('tree')(data);
            CRM.cache.set('menubar', {code: CRM.menubar.cacheCode, locale: CRM.config.locale, cid: CRM.config.cid, data: data});
            CRM.menubar.data = data;
            localStorage.setItem('civiMenubar', markup);
            insert(markup);
          });
      }

      // Wait for crm-container present on the page as it's faster than document.ready
      function insert(markup) {
        if ($('#crm-container').length) {
          render(markup);
        } else {
          new MutationObserver(function(mutations, observer) {
            _.each(mutations, function(mutant) {
              _.each(mutant.addedNodes, function(node) {
                if ($(node).is('#crm-container')) {
                  render(markup);
                  observer.disconnect();
                }
              });
            });
          }).observe(document, {childList: true, subtree: true});
        }
      }

      function render(markup) {
        var position = CRM.menubar.attachTo === 'body' ? 'beforeend' : 'afterbegin';
        $(CRM.menubar.attachTo)[0].insertAdjacentHTML(position, markup);
        CRM.menubar.initializePosition();
        $('#civicrm-menu').trigger('crmLoad');
        $(document).ready(function() {
          handleResize();
          $('#civicrm-menu')
            .on('click', 'a[href="#"]', function() {
              // For empty links - keep the menu open and don't jump the page anchor
              return false;
            })
            .on('click', 'a:not([href^="#"])', function(e) {
              if (e.ctrlKey || e.altKey || e.shiftKey || e.metaKey) {
                // Prevent menu closing when link is clicked with a keyboard modifier.
                e.stopPropagation();
              }
            })
            .on('dragstart', function() {
              // Stop user from accidentally dragging menu links
              // This was added because a user noticed they could drag the civi icon into the quicksearch box.
              return false;
            })
            .on('click', 'a[href="#hidemenu"]', function(e) {
              e.preventDefault();
              CRM.menubar.hide(250, true);
            })
            .on('keyup', 'a', function(e) {
              // Simulate a click when spacebar key is pressed
              if (e.which == SPACE_KEY) {
                $(e.currentTarget)[0].click();
              }
            })
            .on('show.smapi', function(e, menu) {
              // Focus menu when opened with an accesskey
              $(menu).siblings('a[accesskey]').focus();
            })
            .smartmenus(CRM.menubar.settings);
          initialized = true;
          CRM.menubar.initializeResponsive();
          CRM.menubar.initializeSearch();
        });
      }
    },
    destroy: function() {
      $.SmartMenus.destroy();
      $('#civicrm-menu-nav').remove();
      initialized = false;
      $('body[class]').attr('class', function(i, c) {
        return c.replace(/(^|\s)crm-menubar-\S+/g, '');
      });
    },
    show: function(speed) {
      if (typeof speed === 'number') {
        $('#civicrm-menu').slideDown(speed, function() {
          $(this).css('display', '');
        });
      }
      $('body')
        .removeClass('crm-menubar-hidden')
        .addClass('crm-menubar-visible');
    },
    hide: function(speed, showMessage) {
      if (typeof speed === 'number') {
        $('#civicrm-menu').slideUp(speed, function() {
          $(this).css('display', '');
        });
      }
      $('body')
        .addClass('crm-menubar-hidden')
        .removeClass('crm-menubar-visible');
      if (showMessage === true && $('#crm-notification-container').length && initialized) {
        var alert = CRM.alert('<a href="#" id="crm-restore-menu" >' + _.escape(ts('Restore CiviCRM Menu')) + '</a>', ts('Menu hidden'), 'none', {expires: 10000});
        $('#crm-restore-menu')
          .click(function(e) {
            e.preventDefault();
            alert.close();
            CRM.menubar.show(speed);
          });
      }
    },
    open: function(itemName) {
      var $item = $('li[data-name="' + itemName + '"] > a', '#civicrm-menu');
      if ($item.length) {
        $('#civicrm-menu').smartmenus('itemActivate', $item);
        $item[0].focus();
      }
    },
    close: $.SmartMenus.hideAll,
    isOpen: function(itemName) {
      if (itemName) {
        return !!$('li[data-name="' + itemName + '"] > ul[aria-expanded="true"]', '#civicrm-menu').length;
      }
      return !!$('ul[aria-expanded="true"]', '#civicrm-menu').length;
    },
    spin: function(spin) {
      $('.crm-logo-sm', '#civicrm-menu').toggleClass('fa-spin', spin);
    },
    getItem: function(itemName) {
      return traverse(CRM.menubar.data.menu, itemName, 'get');
    },
    addItems: function(position, targetName, items) {
      var list, container, $ul;
      if (position === 'before' || position === 'after') {
        if (!targetName) {
          throw 'Cannot add sibling of main menu';
        }
        list = traverse(CRM.menubar.data.menu, targetName, 'parent');
        if (!list) {
          throw targetName + ' not found';
        }
        var offset = position === 'before' ? 0 : 1;
        position = offset + _.findIndex(list, {name: targetName});
        $ul = $('li[data-name="' + targetName + '"]', '#civicrm-menu').closest('ul');
      } else if (targetName) {
        container = traverse(CRM.menubar.data.menu, targetName, 'get');
        if (!container) {
          throw targetName + ' not found';
        }
        container.child = container.child || [];
        list = container.child;
        var $target = $('li[data-name="' + targetName + '"]', '#civicrm-menu');
        if (!$target.children('ul').length) {
          $target.append('<ul>');
        }
        $ul = $target.children('ul').first();
      } else {
        list = CRM.menubar.data.menu;
      }
      if (position < 0) {
        position = list.length + 1 + position;
      }
      if (position >= list.length) {
        list.push.apply(list, items);
        position = list.length - 1;
      } else {
        list.splice.apply(list, [position, 0].concat(items));
      }
      if (targetName && !$ul.is('#civicrm-menu')) {
        $ul.html(getTpl('branch')({items: list, branchTpl: getTpl('branch')}));
      } else {
        $('#civicrm-menu > li').eq(position).after(getTpl('branch')({items: items, branchTpl: getTpl('branch')}));
      }
      CRM.menubar.refresh();
    },
    removeItem: function(itemName) {
      var item = traverse(CRM.menubar.data.menu, itemName, 'delete');
      if (item) {
        $('li[data-name="' + itemName + '"]', '#civicrm-menu').remove();
        CRM.menubar.refresh();
      }
      return item;
    },
    updateItem: function(item) {
      if (!item.name) {
        throw 'No name passed to CRM.menubar.updateItem';
      }
      var menuItem = CRM.menubar.getItem(item.name);
      if (!menuItem) {
        throw item.name + ' not found';
      }
      _.extend(menuItem, item);
      $('li[data-name="' + item.name + '"]', '#civicrm-menu').replaceWith(getTpl('branch')({items: [menuItem], branchTpl: getTpl('branch')}));
      CRM.menubar.refresh();
    },
    refresh: function() {
      if (initialized) {
        $('#civicrm-menu').smartmenus('refresh');
        handleResize();
      }
    },
    togglePosition: function(persist) {
      $('body').toggleClass('crm-menubar-over-cms-menu crm-menubar-below-cms-menu');
      CRM.menubar.position = CRM.menubar.position === 'over-cms-menu' ? 'below-cms-menu' : 'over-cms-menu';
      handleResize();
      if (persist !== false) {
        CRM.cache.set('menubarPosition', CRM.menubar.position);
      }
    },
    initializePosition: function() {
      if (CRM.menubar.position === 'over-cms-menu' || CRM.menubar.position === 'below-cms-menu') {
        $('#civicrm-menu')
          .on('click', 'a[href="#toggle-position"]', function(e) {
            e.preventDefault();
            CRM.menubar.togglePosition();
          })
          .append('<li id="crm-menubar-toggle-position"><a href="#toggle-position" title="' + ts('Adjust menu position') + '"><i class="crm-i fa-arrow-up"></i></a>');
        CRM.menubar.position = CRM.cache.get('menubarPosition', CRM.menubar.position);
      }
      $('body').addClass('crm-menubar-visible crm-menubar-' + CRM.menubar.position);
    },
    initializeResponsive: function() {
      var $mainMenuState = $('#crm-menubar-state');
      // hide mobile menu beforeunload
      $(window).on('beforeunload unload', function() {
        CRM.menubar.spin(true);
        if ($mainMenuState[0].checked) {
          $mainMenuState[0].click();
        }
      })
        .on('resize', function() {
          if (!isMobile() && $mainMenuState[0].checked) {
            $mainMenuState[0].click();
          }
          handleResize();
        });
      $mainMenuState.click(function() {
        // Use absolute position instead of fixed when open to allow scrolling menu
        var open = $(this).is(':checked');
        if (open) {
          window.scroll({top: 0});
        }
        $('#civicrm-menu-nav')
          .css('position', open ? 'absolute' : '')
          .parentsUntil('body')
          .css('position', open ? 'static' : '');
      });
    },
    initializeSearch: function() {
      $('input[name=qfKey]', '#crm-qsearch').attr('value', CRM.menubar.qfKey);
      $('#crm-qsearch-input')
        .autocomplete({
          source: function(request, response) {
            //start spinning the civi logo
            CRM.menubar.spin(true);
            var
              option = $('input[name=quickSearchField]:checked'),
              params = {
                name: request.term,
                field_name: option.val()
              };
            CRM.api3('contact', 'getquick', params).done(function(result) {
              var ret = [];
              if (result.values.length > 0) {
                $('#crm-qsearch-input').autocomplete('widget').menu('option', 'disabled', false);
                $.each(result.values, function(k, v) {
                  ret.push({value: v.id, label: v.data});
                });
              } else {
                $('#crm-qsearch-input').autocomplete('widget').menu('option', 'disabled', true);
                var label = option.closest('label').text();
                var msg = ts('%1 not found.', {1: label});
                // Remind user they are not searching by contact name (unless they enter a number)
                if (params.field_name !== 'sort_name' && !(/[\d].*/.test(params.name))) {
                  msg += ' ' + ts('Did you mean to search by Name/Email instead?');
                }
                ret.push({value: '0', label: msg});
              }
              response(ret);
              //stop spinning the civi logo
              CRM.menubar.spin(false);
              CRM.menubar.close();
            });
          },
          focus: function (event, ui) {
            return false;
          },
          select: function (event, ui) {
            if (ui.item.value > 0) {
              document.location = CRM.url('civicrm/contact/view', {reset: 1, cid: ui.item.value});
            }
            return false;
          },
          create: function() {
            $(this).autocomplete('widget').addClass('crm-quickSearch-results');
          }
        })
        .on('keyup change', function() {
          $(this).toggleClass('has-user-input', !!$(this).val());
        })
        .keyup(function(e) {
          CRM.menubar.close();
          if (e.which === ENTER_KEY) {
            if (!$(this).val()) {
              CRM.menubar.open('QuickSearch');
            }
          }
        });
      $('#crm-qsearch > a').keyup(function(e) {
        if ($(e.target).is(this)) {
          $('#crm-qsearch-input').focus();
          CRM.menubar.close();
        }
      });
      $('#crm-qsearch form[name=search_block]').on('submit', function() {
        if (!$('#crm-qsearch-input').val()) {
          return false;
        }
        var $menu = $('#crm-qsearch-input').autocomplete('widget');
        if ($('li.ui-menu-item', $menu).length === 1) {
          var cid = $('li.ui-menu-item', $menu).data('ui-autocomplete-item').value;
          if (cid > 0) {
            document.location = CRM.url('civicrm/contact/view', {reset: 1, cid: cid});
            return false;
          }
        }
      });
      $('#civicrm-menu').on('show.smapi', function(e, menu) {
        if ($(menu).parent().attr('data-name') === 'QuickSearch') {
          $('#crm-qsearch-input').focus();
        }
      });
      function setQuickSearchValue() {
        var $selection = $('.crm-quickSearchField input:checked'),
          label = $selection.parent().text(),
          value = $selection.val();
        // These fields are not supported by advanced search
        if (!value || value === 'first_name' || value === 'last_name') {
          value = 'sort_name';
        }
        $('#crm-qsearch-input').attr({name: value, placeholder: '\uf002 ' + label});
      }
      $('.crm-quickSearchField').click(function() {
        var input = $('input', this);
        // Wait for event - its default was prevented by our link handler which interferes with checking the radio input
        window.setTimeout(function() {
          input.prop('checked', true);
          CRM.cache.set('quickSearchField', input.val());
          setQuickSearchValue();
          $('#crm-qsearch-input').focus().autocomplete("search");
        }, 1);
      });
      var savedDefault = CRM.cache.get('quickSearchField');
      if (savedDefault) {
        $('.crm-quickSearchField input[value="' + savedDefault + '"]').prop('checked', true);
      } else {
        $('.crm-quickSearchField:first input').prop('checked', true);
      }
      setQuickSearchValue();
      $('#civicrm-menu').on('activate.smapi', function(e, item) {
        return !$('ul.crm-quickSearch-results').is(':visible:not(.ui-state-disabled)');
      });
    },
    treeTpl:
      '<nav id="civicrm-menu-nav">' +
        '<input id="crm-menubar-state" type="checkbox" />' +
        '<label class="crm-menubar-toggle-btn" for="crm-menubar-state">' +
          '<span class="crm-menu-logo"></span>' +
          '<span class="crm-menubar-toggle-btn-icon"></span>' +
          '<%- ts("Toggle main menu") %>' +
        '</label>' +
        '<ul id="civicrm-menu" class="sm sm-civicrm">' +
          '<%= searchTpl({items: search}) %>' +
          '<%= branchTpl({items: menu, branchTpl: branchTpl}) %>' +
        '</ul>' +
      '</nav>',
    searchTpl:
      '<li id="crm-qsearch" data-name="QuickSearch">' +
        '<a href="#"> ' +
          '<form action="<%= CRM.url(\'civicrm/contact/search/advanced\') %>" name="search_block" method="post">' +
            '<div>' +
              '<input type="text" id="crm-qsearch-input" name="sort_name" placeholder="\uf002" accesskey="q" />' +
              '<input type="hidden" name="hidden_location" value="1" />' +
              '<input type="hidden" name="hidden_custom" value="1" />' +
              '<input type="hidden" name="qfKey" />' +
              '<input type="hidden" name="_qf_Advanced_refresh" value="Search" />' +
            '</div>' +
          '</form>' +
        '</a>' +
        '<ul>' +
          '<% _.forEach(items, function(item) { %>' +
            '<li><a href="#" class="crm-quickSearchField"><label><input type="radio" value="<%= item.key %>" name="quickSearchField"> <%- item.value %></label></a></li>' +
          '<% }) %>' +
        '</ul>' +
      '</li>',
    branchTpl:
      '<% _.forEach(items, function(item) { %>' +
        '<li <%= attr("li", item) %>>' +
          '<a <%= attr("a", item) %>>' +
            '<% if (item.icon) { %>' +
              '<i class="<%- item.icon %>"></i>' +
            '<% } %>' +
            '<% if (item.label) { %>' +
              '<span><%- item.label %></span>' +
            '<% } %>' +
          '</a>' +
          '<% if (item.child) { %>' +
            '<ul><%= branchTpl({items: item.child, branchTpl: branchTpl}) %></ul>' +
          '<% } %>' +
        '</li>' +
      '<% }) %>'
  }, CRM.menubar || {});

  function getTpl(name) {
    if (!templates) {
      templates = {
        branch: _.template(CRM.menubar.branchTpl, {imports: {_: _, attr: attr}}),
        search: _.template(CRM.menubar.searchTpl, {imports: {_: _, ts: ts, CRM: CRM}})
      };
      templates.tree = _.template(CRM.menubar.treeTpl, {imports: {branchTpl: templates.branch, searchTpl: templates.search, ts: ts}});
    }
    return templates[name];
  }

  function handleResize() {
    if (!isMobile() && ($('#civicrm-menu').height() >= (2 * $('#civicrm-menu > li').height()))) {
      $('body').addClass('crm-menubar-wrapped');
    } else {
      $('body').removeClass('crm-menubar-wrapped');
    }
  }

  // Figure out if we've hit the mobile breakpoint, based on the rule in crm-menubar.css
  function isMobile() {
    return $('.crm-menubar-toggle-btn', '#civicrm-menu-nav').css('top') !== '-99999px';
  }

  function traverse(items, itemName, op) {
    var found;
    _.each(items, function(item, index) {
      if (item.name === itemName) {
        found = (op === 'parent' ? items : item);
        if (op === 'delete') {
          items.splice(index, 1);
        }
        return false;
      }
      if (item.child) {
        found = traverse(item.child, itemName, op);
        if (found) {
          return false;
        }
      }
    });
    return found;
  }

  function attr(el, item) {
    var ret = [], attr = _.cloneDeep(item.attr || {}), a = ['rel', 'accesskey'];
    if (el === 'a') {
      attr = _.pick(attr, a);
      attr.href = item.url || "#";
    } else {
      attr = _.omit(attr, a);
      attr['data-name'] = item.name;
      if (item.separator) {
        attr.class = (attr.class ? attr.class + ' ' : '') + 'crm-menu-border-' + item.separator;
      }
    }
    _.each(attr, function(val, name) {
      ret.push(name + '="' + val + '"');
    });
    return ret.join(' ');
  }

  CRM.menubar.initialize();

})(CRM.$, CRM._);
;
// https://civicrm.org/licensing
jQuery(function($) {
  $('body')
    // Enable administrators to edit option lists in a dialog
    .on('click', 'a.crm-option-edit-link', CRM.popup)
    .on('crmPopupFormSuccess', 'a.crm-option-edit-link', function() {
      $(this).trigger('crmOptionsEdited');
      var optionEditPath = $(this).data('option-edit-path');
      var $selects = $('select[data-option-edit-path="' + optionEditPath + '"]');
      var $inputs = $('input[data-option-edit-path="' + optionEditPath + '"]');
      var $radios = $inputs.filter('[type=radio]');
      var $checkboxes = $inputs.filter('[type=checkbox]');

      if ($selects.length > 0) {
        rebuildOptions($selects, CRM.utils.setOptions);
      }
      else if ($radios.length > 0) {
        rebuildOptions($radios, rebuildRadioOptions);
      }
      else if ($checkboxes.length > 0) {
        rebuildOptions($checkboxes, rebuildCheckboxOptions);
      }
    });

  /**
   * Fetches options using metadata from the existing ones and calls the
   * function to rebuild them
   * @param $existing {object} The existing options, used as metadata store
   * @param rebuilder {function} Function to be called to rebuild the options
   */
  function rebuildOptions($existing, rebuilder) {
    if ($existing.data('api-entity') && $existing.data('api-field')) {
      var params = {
        sequential: 1,
        field: $existing.data('api-field')
      };
      $.extend(params, $existing.data('option-edit-context'));

      CRM.api3($existing.data('api-entity'), 'getoptions', params)
      .done(function(data) {
        rebuilder($existing, data.values);
      });
    }
  }

  /**
   * Rebuild checkbox input options, overwriting the existing options
   *
   * @param $existing {object} the existing checkbox options
   * @param newOptions {array} in format returned by api.getoptions
   */
  function rebuildCheckboxOptions($existing, newOptions) {
    var $parent = $existing.first().parent(),
      $firstExisting = $existing.first(),
      optionName = $firstExisting.attr('name'),
      optionAttributes =
        'data-option-edit-path =' + $firstExisting.data('option-edit-path') +
        ' data-api-entity = ' + $firstExisting.data('api-entity') +
        ' data-api-field = ' + $firstExisting.data('api-field');

    var prefix = optionName.substr(0, optionName.lastIndexOf("["));

    var checkedBoxes = [];
    $parent.find('input:checked').each(function() {
      checkedBoxes.push($(this).attr('id'));
    });

    // remove existing checkboxes
    $parent.find('input[type=checkbox]').remove();

    // find existing labels for the checkboxes
    var $checkboxLabels = $parent.find('label').filter(function() {
      var forAttr = $(this).attr('for') || '';

      return forAttr.indexOf(prefix) !== -1;
    });

    // find what is used to separate the elements; spaces or linebreaks
    var $elementAfterLabel = $checkboxLabels.first().next();
    var separator = $elementAfterLabel.is('br') ? '<br/>' : '&nbsp;';

    // remove existing labels
    $checkboxLabels.remove();

    // remove linebreaks in container
    $parent.find('br').remove();

    // remove separator whitespace in container
    $parent.html(function (i, html) {
      return html.replace(/&nbsp;/g, '');
    });

    var renderedOptions = '';
    // replace missing br at start of element
    if (separator === '<br/>') {
      $parent.prepend(separator);
      renderedOptions = separator;
    }

    newOptions.forEach(function(option) {
      var optionId = prefix + '_' + option.key,
        checked = '';

      if ($.inArray(optionId, checkedBoxes) !== -1) {
        checked = ' checked="checked"';
      }

      renderedOptions += '<input type="checkbox" ' +
        ' value="1"' +
        ' id="' + optionId + '"' +
        ' name="' + prefix + '[' + option.key +']' + '"' +
        checked +
        ' class="crm-form-checkbox"' +
        optionAttributes +
        '><label for="' + optionId + '">' + option.value + '</label>' +
        separator;
    });

    // remove final separator
    renderedOptions = renderedOptions.substring(0, renderedOptions.lastIndexOf(separator));

    var $editLink = $parent.find('.crm-option-edit-link');

    // try to insert before the edit link to maintain structure
    if ($editLink.length > 0) {
      $(renderedOptions).insertBefore($editLink);
    }
    else {
      $parent.append(renderedOptions);
    }
  }

  /**
   * Rebuild radio input options, overwriting the existing options
   *
   * @param $existing {object} the existing input options
   * @param newOptions {array} in format returned by api.getoptions
   */
  function rebuildRadioOptions($existing, newOptions) {
    var $parent = $existing.first().parent(),
      $firstExisting = $existing.first(),
      optionName = $firstExisting.attr('name'),
      renderedOptions = '',
      checkedValue = parseInt($parent.find('input:checked').attr('value')),
      optionAttributes =
        'data-option-edit-path =' + $firstExisting.attr('data-option-edit-path') +
        ' data-api-entity = ' + $firstExisting.attr('data-api-entity') +
        ' data-api-field = ' + $firstExisting.attr('data-api-field');

    // remove existing radio inputs and labels
    $parent.find('input, label').remove();

    newOptions.forEach(function(option) {
      var optionId = 'CIVICRM_QFID_' + option.key + '_' + optionName,
        checked = (option.key === checkedValue) ? ' checked="checked"' : '';

      renderedOptions += '<input type="radio" ' +
        ' value=' + option.key +
        ' id="' + optionId +'"' +
        ' name="' + optionName + '"' +
        checked +
        ' class="crm-form-radio"' +
        optionAttributes +
        '><label for="' + optionId + '">' + option.value + '</label> ';
    });

    $parent.prepend(renderedOptions);
  }
});
;
if (!window.CRM) window.CRM = {};
window.cj = CRM.$ = jQuery.noConflict(true);
CRM._ = _.noConflict();
;
