/*
 boxmobi prototype;
 Level 2;
*/ 
var shop = {
  _store : {
	ajax: {},
	data: {},
	method: {},
	variable: {}
  },
  _all_popup: {},
  _show_popup : {},
  /*------ begin active popup -----*/
  _active_popup : function(popup_id, title, content, option) {
	if (shop.is_exists(shop._all_popup[popup_id])) {
	  var popup = shop.get_ele(popup_id);
	  jQuery(popup).remove();
	}
	var config = {
	  background_image : 'style/images/button/close.png',
	  auto_hide: 0,
	  position : 'default', //default, center-center, top-left, top-center, top-right, bottom-left, bottom-center, bottom-right
	  pos_type : 'absolute',
	  type: 'show-hide', //overlay, one-time, show-hide
	  overlay: {
		'background-color' : '#000',
		'opacity' : '0.8'
	  },
	  background:{
		'background-color' : '#fff'
	  },
	  border: {
		'background-color' : '#bebebe',
		'padding' : '5px'
	  },
	  title : {
		'background-color' : '#034b8a',
		'color' : '#fff',
		'status': 1,
		'display' : 'block'
	  },
	  content : {
		'width' : '500px',
		'height': 'auto',
		'padding' : '20px',
		'display' : 'block'
	  },
	  before: function(){},
	  release: function(){},
	  onclose: function(){}
	};
	if (shop.is_exists(option)) { //load config;
	  for(var o in option) {
		if(!Object.prototype[o] && shop.is_exists(option[o])) {
		  if (shop.is_func(option[o])) {
			  config[o] = option[o];
		  } else if (shop.is_obj(option[o])) {
			for (var i in option[o]) {
			  var sub_opt = option[o];
			  if (!Object.prototype[i] && shop.is_exists(sub_opt[i])) {
				config[o][i] = sub_opt[i];
			  }
			}
		  } else {
			config[o] = option[o];
		  }
		}
	  }
	}
	shop._all_popup[popup_id] = config.type;
	//get site dimension;
	var windowHeight = jQuery(window).height();
	var windowWidth = jQuery(window).width();
	var pageHeight = jQuery(document).height() ;
	var pageWidth = jQuery(document).width();
	//create overlay popup;
	if (config.type == 'overlay') {
	  var oPopup = jQuery('<div id=' + popup_id + '> </div>')
	  .css({
		'background-color' : config.overlay['background-color'],
		'opacity': config.overlay['opacity'],
		'position' : config.pos_type,
		'top' : '0px',
		'left' : '0px',
		'z-index' : '332',
		'width' : '100%'
	  }).height(pageHeight).appendTo('body');
	} else {
	  //detect close button type;
	  var close_button, close_button_hover;
	  if (config.title.status == 1) {
		close_button = 'popup-close-button pcb-blue-normal';
		close_button_hover = 'popup-close-button pcb-blue-hover';
	  } else if (config.title.status == -1){
		close_button = 'popup-close-button pcb-red-normal';
		close_button_hover = 'popup-close-button pcb-red-hover';
	  } else {
		close_button = 'popup-close-button pcb-orange-normal';
		close_button_hover = 'popup-close-button pcb-orange-hover';
	  }
	  var oButton = jQuery('<div></div>')
	  .addClass(close_button)
	  .mouseover(function(){
		this.className = close_button_hover;
	  }).mouseout(function(){
		this.className = close_button;
	  }).click(function(){
		shop._hide_popup(popup_id);
	  });

	  var sTitle = jQuery('<div style="fload: left;">'+title+'</div>');
	  var oTitle = jQuery('<div></div>')
	  .css({
		'padding-left' : '20px',
		'font-size' : '16px',
		'font-weight' : 'bold',
		'height' : '33px',
		'line-height' : '33px',
		'cursor' : 'pointer',
		'display' : config.title['display'],
		'color' : config.title['color'],
		'background-color' : config.title['background-color']
	  }).append(oButton).append(sTitle).append('<div style="clear: both;"/></div>');

	  var oContent = jQuery('<div id="popup-container" style="padding: 20px; color: black"></div>')
	  .css({
		'font-size' : shop.is_exists(config.content['font-size']) ? config.content['font-size'] : '14px',
		'height' : config.content['height'],
		'padding' : config.content['padding'],
		'display' : config.content['display']
	  });

	  var content_popup_id = null;
	  var content_popup_state = null;
	  if (shop.is_str(content)) {
		oContent.html(content);
	  } else if (shop.is_ele(content)) {
		//store state content visibility;
		content_popup_id = content.id;
		content_popup_state = content.style.display;
		oContent.append(content);
		content.style.display = "block";
	  }

	  var blockContent = jQuery('<div style="background-color: '+config.background['background-color']+'"></div>');

	  var oPopup = jQuery('<div id=' + popup_id + '></div>')
	  .css({
		'background-color' : config.border['background-color'],
		'position' : config.pos_type,
		'padding' : config.border['padding'],
		'opacity' : '0.4',
		'z-index' : '333',
		'width' : config.content['width']
	  }).append(blockContent.append(oTitle).append(oContent)).appendTo('body').fadeTo("slow", 1);

	  //store state of content popup;
	  if (content_popup_id) {
		shop.get_ele(popup_id).content_popup = {
		  id : content_popup_id,
		  state : content_popup_state
		};
	  }

	  config.before(oPopup);
	  //display popup;
	  switch (config.position) {
		case 'top-left': oPopup.css({'top': 0,'left':0}); break;
		case 'top-center': oPopup.css({'top': 0,'left':(pageWidth - oPopup.width()) / 2}); break;
		case 'top-right': oPopup.css({'top': 0,'right' : 0}); break;
		case 'center-center': oPopup.css({'top':  (windowHeight - oPopup.height()) / 2,'left' : (pageWidth - oPopup.width()) / 2}); break;
		case 'bottom-left': oPopup.css({'bottom': 0,'left' : 0}); break;
		case 'bottom-center': oPopup.css({'bottom': 0, 'left' : (pageWidth - oPopup.width()) / 2}); break;
		case 'bottom-right':  oPopup.css({'bottom': 0,'right' : 0}); break;
		case 'default': oPopup.css({'top': shop.get_top_page() + 92,'left' : (pageWidth - oPopup.width()) / 2}); break;
	  }// end of else;
	}

	//auto hide;
	if (config.auto_hide) {
	  setTimeout(function() {
		oPopup.fadeTo('show', 0, function() {
		  if (config.type != 'show-hide') {
			jQuery(this).remove();
		  } else  {
			jQuery(this).hide();
		  }
		});
	  },
	  config.auto_hide);
	}
	shop.get_ele(popup_id).onclose = config.onclose;
	config.release(oPopup);
	return oPopup;
  },
/*----- end active popup ------*/
  _hide_popup: function(id) {
	var popup = shop.get_ele(id);
	if (shop.is_ele(popup)) {
	  //remove overlay popup if it exists;
	  shop.hide_popup(popup.overlay_popup);
	  //restore state visibility;
	  if (shop.is_exists(popup.content_popup)) {
		var content_popup = shop.get_ele(popup.content_popup.id);
		content_popup.style.display = popup.content_popup.state;
	  }
	  //remove chaos popup;
	  if (shop._all_popup[id] == 'one-time' || shop._all_popup[id] == 'overlay') {
		shop._all_popup[id] = null;
		delete shop._all_popup[id];
		popup.parentNode.removeChild(popup);
	  } else {
		popup.style.display = "none";
	  }
	  var onclose = popup.onclose;
	  if (shop.is_func(onclose)) {
		onclose();
	  } else if (shop.is_str(onclose)) {
		eval(onclose);
	  }
	}
  }
};

//check every thing;
shop.is_arr = function(arr) { return (arr != null && arr.constructor == Array) };

shop.is_str = function(str) { return (str && (/string/).test(typeof str)) };

shop.is_func = function(func) { return (func != null && func.constructor == Function) };

shop.is_num = function(num) { return (num != null && num.constructor == Number) };

shop.is_obj = function(obj) { return (obj != null && obj instanceof Object) };

shop.is_ele = function(ele) { return (ele && ele.tagName && ele.nodeType == 1) };

shop.is_exists = function(obj) { return (obj != null && obj != undefined && obj != "undefined") };

shop.is_json = function(){};

shop.is_blank = function(str) { return (shop.util_trim(str) == "") };

shop.is_phone = function(num) {
  //return (/^(0120|0121|0122|0123|0124|0125|0126|0127|0128|0129|0163|0164|0165|0166|0167|0168|0169|0188|0199|090|091|092|093|094|095|096|097|098|099)(\d{7})$/i).test(num);
  return (/^(01([0-9]{2})|09[0-9])(\d{7})$/i).test(num);
};

shop.is_email = function(str) { return (/^[a-z][a-z-_0-9\.]+@[a-z-_=>0-9\.]+\.[a-z]{2,3}$/i).test(shop.util_trim(str))};

shop.is_username = function(value){ return (value.match(/^[0-9]/) == null) && (value.search(/^[0-9_a-zA-Z]*$/) > -1); }

shop.is_link = function(str){ return (/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/).test(shop.util_trim(str)) };

shop.is_image = function(imagePath){
  var fileType = imagePath.substring(imagePath.lastIndexOf("."),imagePath.length).toLowerCase();
  return (fileType == ".gif") || (fileType == ".jpg") || (fileType == ".png") || (fileType == ".jpeg");
};

shop.is_fullname = function(fullname){
    fullname = shop.util_trim(fullname);
    var aName = fullname.split(' ');
    if ((aName.length<2) || (aName.length>10)) return false;
    for (id in aName){
        if (aName[id].length>15) return false;
    }
    return true;
};

shop.is_ascii_fullname = function(fullname){
    fullname = shop.util_trim(fullname);
    var aName = fullname.split(' ');
    if ((aName.length<2) || (aName.length>10)) return false;
    for (id in aName)
    if (aName[id].length>0){
        if (aName[id].length>15) return false;
        if (!(/^[a-zA-Z]*$/).test(aName[id])) return false;
    }
    return true;
};

shop.is_ff  = function(){ return (/Firefox/).test(navigator.userAgent) };

shop.is_ie  = function() { return (/MSIE/).test(navigator.userAgent) };

shop.is_ie6 = function() { return (/MSIE 6/).test(navigator.userAgent) };

shop.is_ie7 = function() { return (/MSIE 7/).test(navigator.userAgent) };

shop.is_ie8 = function() { return (/MSIE 8/).test(navigator.userAgent) };

shop.is_chrome = function(){ return (/Chrome/).test(navigator.userAgent) };

shop.is_opera = function() { return (/Opera/).test(navigator.userAgent) };

shop.is_safari = function(){ return (/Safari/).test(navigator.userAgent) };

//working with ajax;
shop.ajax_get = function(){};
shop.ajax_post = function(){};

shop.ajax_popup = function(url, method, param, callback, option) {
  if (!shop.is_exists(url)) return;
  var data = '',
  opt = {
	loading: (shop.is_obj(option) && shop.is_func(option.loading)) ? option.loading : shop.show_loading,
	error: (shop.is_obj(option) && shop.is_func(option.error)) ? option.error : shop.hide_loading
  };
  if(shop.is_obj(param)) {
	for (var key in param) {
	  if (Object.prototype[key]) continue;
	  data += '&' + key + '=' + param[key];
	}
  } else if (shop.is_str(param)) {
	data = '&' + param;
  }
  var old_ajax = shop._store.ajax[url];
  if (shop.is_exists(old_ajax) && old_ajax === data) {
	return;
  } else {
	shop._store.ajax[url] = data;
  }
  data += '&rand=' + Math.random();
  jQuery.ajax({
	beforeSend: opt.loading,
	url : (typeof BASE_URL != 'undefined')?BASE_URL:'' + 'ajax.php?' + url,
	type: method ? method : 'POST',
	data: data,
	dataType: 'json',
	success: function(xhr) {
	  shop._store.ajax[url] = null;
	  delete shop._store.ajax[url];
	  shop.hide_loading();
	  if (xhr && shop.is_exists(xhr.intReturn)) {
		switch(xhr.intReturn) {
		  case -1: shop.show_popup_message(xhr.msg, "Thông báo lỗi!", -1); break;
		  case 0:  shop.show_popup_message(xhr.msg, "Cảnh báo", 0); break;
		  case 1:  shop.show_popup_message(xhr.msg, "Thông báo", 1);break;
		}
	  }
	  if (xhr && shop.is_exists(xhr.script)) {
		eval(xhr.script);
	  }
	  if(shop.is_exists(callback)) {
		callback(xhr);
	  }
	},
	error: function(xhr) {
	  shop._store.ajax[url] = null;
	  delete shop._store.ajax[url];
	  opt.error();
	  //shop.show_popup_message("L?i k?t n?i m?ng", "Th�ng b�o l?i!", -1);
	}
  });
};

shop.ajax_tab = function(){};

shop.show_loading = function (txt){
  txt = shop.is_str(txt) ? txt : 'Đang tải dữ liệu ...';
  jQuery('.float_loading').remove();
  jQuery('body').append('<div class="float_loading">'+txt+'</div>');
  jQuery('.float_loading').fadeTo("fast",0.9);
  shop.update_position();
  jQuery(window).scroll(shop.updatePosition);
};

shop.update_position = function(){
  if (shop.is_ie()) {
	jQuery('.mine_float_loading').css('top', document.documentElement['scrollTop']);
  }
};

shop.hide_loading = function() {
  jQuery('.float_loading').fadeTo("slow",0,function(){jQuery(this).remove();});
};

//working with popup;
shop.show_popup =  function(popup_id, title, content, option) {
  shop.hide_all_popup();
  shop._active_popup(popup_id, title, content, option);
};

shop.hide_popup = function(id) {shop._hide_popup(id)};

shop.show_next_popup = function(popup_id, title, content, option) {
  shop._active_popup(popup_id, title, content, option);
};

shop.hide_all_popup = function() {
  for(var i in shop._all_popup) {
	if (Object.prototype[i]) continue;
	shop._hide_popup(i);
  }
};

//hide all popup when press esc;
jQuery(document).keydown(
  function(event) {
	if (event.keyCode == 27) {
	  shop.hide_all_popup();
	}
  }
);

shop.show_overlay_popup = function(popup_id, title, content, option) {
  shop.hide_all_popup();
  shop._active_popup('overlay-popup','','',{
	type: 'overlay',
	overlay: shop.is_exists(option) ? option.overlay : null
  });
  shop._active_popup(popup_id, title, content, option);
  //store to remove;
  shop.get_ele(popup_id).overlay_popup = 'overlay-popup';
  //update height;
  shop.get_ele('overlay-popup').style.height =  jQuery(document).height() + 92 + 'px';
};

shop.hide_overlay_popup = function(id) {
  window.parent.$("#showSohaPay").hide();
  window.parent.$("#overlay-popup").css("opacity","0");
  window.parent.$("#overlay-popup").hide();
  shop.hide_popup(id);
  shop.hide_popup('overlay-popup');
  window.parent.shop.hide_popup(id);
};


shop.show_popup_message = function(message, title, type, width, height) {
  var bg_color;
  if (type == -1) {
	bg_color = '#ba0000';
  } else if (type == 0) {
	bg_color = '#ec6f00';
  } else {
	bg_color = '#034b8a';
  }

  var id_overlay = shop.get_uuid();
  shop._active_popup(id_overlay, "", "", {
	type: "overlay",
	auto_hide: 3000,
	overlay : {
	  'opacity' : 0.3,
	  'background-color' : '#fff'
	}
  });

  var id_popup = shop.get_uuid();
  shop._active_popup(id_popup, title, message, {
	type: 'one-time',
	auto_hide: 3000,
	title: {
	  'background-color' : bg_color,
	  'status' : type
	},
	content: {
	  'width' : width ? width : '300px',
	  'height' : height ? height : 'auto'
	}
  });
  //store to remove;
  shop.get_ele(id_popup).overlay_popup = id_overlay;
  //update height;
  shop.get_ele(id_overlay).style.height =  jQuery(document).height() + 'px';
};

shop.show_access_notify = function() {
  shop.show_overlay_popup(
	"popup_access_notify",
	"Th�ng b�o",
	shop.get_ele("access_notify"),
	{
	  title: {
		'background-color' : 'red',
		'status' : -1
	  },
	  content: {width: '400px'}
	}
  );
};

shop.confirm = function(message, callback, callback_data) {
	//halm: update data for callback function :D
	shop.show_next_popup(
	  "popup_confirm",
	  "X�c nh?n",
	  shop.join
	  ('<div style="font-weight: bold; margin: 0 0 10px;">' + message + '</div>')
	  ('<div align="center"><input type="button" value="�?ng �" onclick="shop.confirm_ok()" />&nbsp;&nbsp;&nbsp;')
	  ('<input type="button" value="H?y b?" onclick="shop.hide_popup(\'popup_confirm\')" /></div>')(),
	  {content: {width: "300px"}}
	);
	shop._store.method["popup_confirm"] = callback;
	shop._store.method["popup_confirm_data"] = callback_data;
};

shop.confirm_ok = function(){
  shop._store.method["popup_confirm"](shop._store.method["popup_confirm_data"]);
  shop.hide_popup("popup_confirm");
  shop._store.method["popup_confirm"] = null;
  shop._store.method["popup_confirm_data"] = null;
  delete shop._store.method["popup_confirm"];
  delete shop._store.method["popup_confirm_data"];
};

//Working with something;
shop.util_trim = function(str) {return (/string/).test(typeof str) ? str.replace(/^\s+|\s+$/g, "") : ""};

shop.util_random = function(a, b) { return Math.floor(Math.random() * (b - a + 1)) + a };

shop.get_ele = function(id) { return document.getElementById(id) };

shop.get_uuid = function() { return (new Date().getTime() + Math.random().toString().substring(2))};

shop.get_top_page = function() {
  if (shop.is_exists(window.pageYOffset)) {
	return window.pageYOffset;
  }
  if (shop.is_exists(document.compatMode) && document.compatMode != 'BackCompat') {
	return document.documentElement.scrollTop;
  }
  if (shop.is_exists(document.body)) {
	scrollPos = document.body.scrollTop;
  }
  return 0;
};

shop.get_form = function(form_id) {
  var form = shop.get_ele(form_id);

  if (!shop.is_ele(form)) return '';

  var arr = [], inputs = form.getElementsByTagName("input");

  for (var i = 0; i < inputs.length; i ++) {
	var item = inputs[i];
	if (item.type != 'button') {
	  arr.push(item.name + "=" + encodeURIComponent(item.value));
	}
  }

  var selects = form.getElementsByTagName("select");

  for (var i = 0; i < selects.length; i ++) {
	var item = selects[i],
	key = item.name,
	value = item.options[item.selectedIndex].value;
	arr.push(key + "=" + encodeURIComponent(value));
  }

  var textareas = form.getElementsByTagName("textarea");

  for (var i = 0; i < textareas.length; i ++) {
	var item = textareas[i];
	arr.push(item.name + "=" + encodeURIComponent(item.value));
  }

  return arr.join("&");
};

/*
  Level 3
*/

//halm: fade image to hide loading
shop.fadeImageLoading = function(obj, speed, width, height) {
  speed = speed ? speed : 400;
  jQuery(obj).fadeTo(speed,1,function(){
	if(width){
	  jQuery(obj).parent().css({width:'auto'});
	}
	if(height){
	  jQuery(obj).parent().css({height:'auto'});
	}
  });
};
	
// using to fix with for image;	
shop.fix_width_element = function(obj, limit) {
  var width = jQuery(obj).width(),
  height = jQuery(obj).height(),
  max_width = limit || 468;
  if (width > max_width) {
	var ratio = (height / width );
	var new_width = max_width;
	var new_height = (new_width * ratio);
	jQuery(obj).height(new_height).width(new_width);
  }
};

//redirect to url
shop.redirect = function(url){window.location = url};

//show form error
shop.raiseError = function(id, msg, focus, cl, icon){
  if(focus){jQuery(id).focus()}
  if(cl == undefined || cl == null || cl==''){
    jQuery(id).addClass('error');
  }else{
	jQuery(id).removeClass('error');
  }
  var p = jQuery(id).parent();
  jQuery('.showErr',p).remove();
  if(icon){
	jQuery('.showErrIconFalse',p).remove();
	jQuery('.showErrIconTrue',p).remove();
  }
  p.append((icon?'<span class="showErrIcon'+(cl?'True':'False')+'"></span>':'')+'<span class="pLeft5 showErr"><font color="'+(cl?'green':'red')+'">'+msg+'</font></span>');
};

//close form error
shop.closeErr = function (id, icon){
  jQuery(id).removeClass('error');
  var p = jQuery(id).parent();
  jQuery('.showErr',p).remove();
  if(icon){
	jQuery('.showErrIconFalse',p).addClass('showErrIconTrue').removeClass('showErrIconFalse');
  }
};

shop.styleInputTxT = function(){
  jQuery(":text,:password").focus(function(){jQuery(this).addClass('active') });
  jQuery(":text,:password").blur(function() {jQuery(this).removeClass('active')});
};

/* function core connect */
String.prototype.E = function() {return shop.get_ele(this)};

shop.join = function(str) {
  var store = [str];
  return function extend(other) {
    if (other != null && 'string' == typeof other ) {
      store.push(other);
      return extend;
    }
    return store.join('');
  }
};

shop.nextNumber = (function(){
  var i = 0;
  return function() {return ++i}
}());

shop.showInputInline = function(obj, value){
  if(jQuery('#inline_input', obj).html() == null){
	obj.innerHTML = shop.join('<input type="text" value="'+value.replace(/(<([^>]+)>)/ig,"")+'" id="inline_input" onblur="shop.closeInputInline(this)" />')('<div class="hidden">'+obj.innerHTML+'</div>')();
	jQuery('#inline_input', obj).select().focus();
  }
};

shop.closeInputInline = function(obj){
  var parent = jQuery(obj).parent(), txt = jQuery('.hidden', parent).html();
  parent.html(txt);
};

shop.numberOnly = function(myfield, e){
  var key,keychar;
  if (window.event){key = window.event.keyCode}
  else if (e){key = e.which}
  else{return true}
  keychar = String.fromCharCode(key);
  if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27)){return true}
  else if (("0123456789").indexOf(keychar) > -1){return true}
  return false;
};

shop.fix_png = function(id) {
  if (navigator.appVersion.match(/MSIE [0-6]\./)) {
	jQuery(id).each(function () {
	  var background_image = jQuery(this).css("backgroundImage");
	  if (background_image != 'none') {
		if (background_image.substring(4, 5) == '"') {
		  var img_src = background_image.substring(5, background_image.length - 2)
		} else {
		  var img_src = background_image.substring(4, background_image.length - 1)
		}
		jQuery(this).css({
		  'backgroundColor': 'transparent',
		  'backgroundImage': 'none',
		  'filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=crop, src='" + img_src + "')"
		})
	  }
	})
  }
};

shop.create3DText = function(id, deep, mainColor, overColor, left){
  deep = deep ? deep : 1;
  var html = jQuery(id).html(),
  w = jQuery(id).width()+deep,
  h = jQuery(id).height()+deep,
  u = shop.get_uuid(),
  c = '#txt3D'+u+' .txt2DMain a{color:'+mainColor+'}#txt3D'+u+' .txt2DOverlay a{color:'+overColor+'}';
  
  html = shop.join
  ('<div class="txt3D" id="txt3D'+u+'" style="position:relative;z-index:0;width:'+w+'px;height:'+h+'px;">')
	('<div class="txt2DMain" style="position:absolute;z-index:3;top:0;left:'+(left?0:'1px')+';width:'+w+'px;height:'+h+'px;color:'+mainColor+'">'+html+'</div>')
	('<div class="txt2DOverlay" style="position:absolute;z-index:1;top:'+deep+'px;left:'+(left?deep+'px':0)+';width:'+w+'px;height:'+h+'px;color:'+overColor+'">'+html+'</div>')
  ('</div>')();
  shop.bindCSS(c);
  jQuery(id).html(html);
};

shop.bindCSS = function (a) {
  var c = document.createElement("style");
  c.type = "text/css";
  document.getElementsByTagName("head")[0].appendChild(c);
  if (c.styleSheet) c.styleSheet.cssText = a;
  else c.appendChild(document.createTextNode(a))
};

shop.goTopStart = function(){
  jQuery('body').append('<a href="javascript:void(0)" onclick="jQuery(\'html,body\').animate({scrollTop: 0},1000);" class="go_top" style="display:none"></a>');
  jQuery(window).scroll(function(){
	var top = 0;
	if(document.documentElement && document.documentElement.clientHeight){
	  top = document.documentElement.scrollTop;
	}else if(document.body){
	  top = document.body.scrollTop;
	}
	if(top > 0){
	  if (shop.is_ie6() || shop.is_ie7()) {
		top = top + jQuery(window).height() - 30;
		jQuery('.go_top').css('top', top);
	  }
	  jQuery('.go_top').show();
	}else{
	  jQuery('.go_top').hide()
	}
  });
};

shop.deleteCache = function(cacheKey){
  shop.ajax_popup("act=admin&code=delcache",'POST',{cacheKey:cacheKey},
	function(j){
		if(j.err == 0){
			shop.cart.theme.systemAlert(
			  shop.join
				('<div style="font-size:14px;margin-top:5px">Xo� cache th�nh c�ng</div>')()
				,'H? th?ng'
			);
		}
	});
};

shop.error = {
  set:function(id, msg, width, cl){
	msg = msg ? msg : '';
	width = width ? width : 430;
	var html = shop.join
	('<div class="my_msg" style="width: '+width+'px; color:red; margin: 5px auto 15px; padding:10px; background:rgb(255, 249, 215); border: 1px solid rgb(226, 200, 34); text-align: center; font-size: 15px;">')
	  (msg)
	('</div>')();
	if(cl){
	  jQuery('#cError', jQuery(cl)).html(html);
	}else{
	  jQuery('#cError').html(html);
	}
	jQuery(id).addClass('error').focus();
  },
  close:function(id, cl){
	if(cl){
	  jQuery('#cError', jQuery(cl)).html('');
	}else{
	  jQuery('#cError').html('');
	}
	jQuery(id).removeClass('error');
  }
};

shop.cookie = {
	set: function(name, value, expires, path, domain, secure) {
		expires instanceof Date ? expires = expires.toGMTString() : typeof(expires) == 'number' && (expires = (new Date( + (new Date) + expires * 1e3)).toGMTString());
		var r = [name + "=" + escape(value)], s, i;
		for (i in s = {
			expires: expires,
			path: path,
			domain: domain
		}){
			s[i] && r.push(i + "=" + s[i])
		}
		return secure && r.push("secure"), document.cookie = r.join(";"), true
	},
	get: function(c_name) {
		if (document.cookie.length > 0) {
			c_start = document.cookie.indexOf(c_name + "=");
			if (c_start != -1) {
				c_start = c_start + c_name.length + 1;
				c_end = document.cookie.indexOf(";", c_start);
				if (c_end == -1) c_end = document.cookie.length;
				return unescape(document.cookie.substring(c_start, c_end))
			}
		}
		return ""
	}
};

shop.serverTimeCounter = function(){
  TIME_NOW=(typeof TIME_NOW != 'undefined') ? TIME_NOW : 0;
  TIME_NOW++;
  var d = new Date(TIME_NOW*1000),
  hour= d.getHours(),
  min = d.getMinutes(),
  sec = 0,
  iSecond = false,
  objectTime = shop.get_ele('serverTimeCounter');
  if(objectTime){
	if(iSecond){sec=d.getSeconds();}
	objectTime.innerHTML = (hour>9?'':'0')+(hour>0?hour:0)+':'+(min>9?'':'0')+(min>0?min:0)+(iSecond?(':'+(sec>9?'':'0')+(sec>0?sec:0)):'');
  }
  setTimeout(shop.serverTimeCounter, 1000);
};
//start timer
shop.serverTimeCounter();

shop.hideProduct = function(id, is_home){
  var count = 0, count2 = 0;
  if(shop.get_ele('blockSold'+id)){
	jQuery('#blockSold'+id).hide();
	if(jQuery('#blockSold'+id).hasClass('first')){
	  jQuery('.blockSoldItemBorder:first').removeClass('blockSoldItemBorder').removeClass('mTop15');
	}
	jQuery('.blockSoldItem').each(function(){count++});
	if(count <= 1){
	  jQuery('.blockSold').parent().parent().parent().hide();
	}
  }else{
	if(is_home){
	  jQuery('.blockSoldItem').each(function(){
		if(jQuery(this).hasClass('blockSoldHide3')){
		  jQuery(this).hide();
		  count++;
		}else{
		  count2++;
		}
	  });
	  if(count2 == 0){
		jQuery('.blockSold').parent().parent().parent().hide();
	  }
	}
	if(count <= 0){
	  jQuery('.blockSoldItemLast').hide();
	}
  }
};
shop.enter = function(id, cb){
  if(cb){
	jQuery(id).keydown(
	  function(event) {
		if (event.keyCode == 13) cb();
	  }
	);
  }
};
shop.numberFormat = function( number, decimals, dec_point, thousands_sep ){
  var n = number, prec = decimals;
  n = !isFinite(+n) ? 0 : +n;
  prec = !isFinite(+prec) ? 0 : Math.abs(prec);
  var sep = (typeof thousands_sep == "undefined") ? '.' : thousands_sep;
  var dec = (typeof dec_point == "undefined") ? ',' : dec_point;
  var s = (prec > 0) ? n.toFixed(prec) : Math.round(n).toFixed(prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;
  var abs = Math.abs(n).toFixed(prec);
  var _, i;
  if (abs >= 1000) {
	  _ = abs.split(/\D/);
	  i = _[0].length % 3 || 3;
	  _[0] = s.slice(0,i + (n < 0)) +
			_[0].slice(i).replace(/(\d{3})/g, sep+'$1');
	  s = _.join(dec);
  } else {
	  s = s.replace(',', dec);
  }
  return s;
};
shop.selectAllText = function(obj){
  obj.focus();
  obj.select();
};
shop.popupSite = function(id, title, content, close, opt){
  close = close ? 'shop.hide_overlay_popup(\''+close+'\');' : '';
  var style = '';
  if(opt){
	  style = 'margin:0 auto;';
	  if(shop.is_exists(opt.width)){
		  style += 'width:'+opt.width+'px;';
	  }
	  if(shop.is_exists(opt.height)){
		  style += 'height:'+opt.height+'px;';
	  }
	  style = ' style="'+style+'"';
  }
  return shop.join
  ('<div class="classic-popup"'+style+'>')
	  ('<div class="classic-popup-top"><div class="right"><div class="bg"></div></div></div>')
	  ('<div class="classic-popup-main">')
		  ('<div class="classic-popup-title">')
			  ('<div class="fl">'+title+'</div>')
			  ('<a href="javascript:void(0)" class="classic-popup-close" title="Đóng" onclick="shop.hide_overlay_popup(\''+id+'\');'+close+'">x</a>')
			  ('<div class="c"></div>')
		  ('</div>')
		  ('<div class="classic-popup-content">'+content+'</div>')
	  ('</div>')
	  ('<div class="classic-popup-bottom"><div class="right"><div class="bg"></div></div></div>')
  ('</div>')();
};
//fix png
jQuery(document).ready(function(){
  shop.fix_png('.fixPNG');
  shop.fix_png('.fixPng');
  if(document.URL.indexOf('admin/') == -1){
	shop.goTopStart();
  }
});