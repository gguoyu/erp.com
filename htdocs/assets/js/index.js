define(function(require, exports, module){
	var $ = require('jquery');
	require('bootstrap')($);
	require('superslide');
	var mustache = require('mustache');

	var cgiUrl = 'index.php'

	function startCarousel(){
		$('.banner').slide({
			titleCell:'.hd ul',
			mainCell:'.bd ul',
			autoPlay:true,
			delayTime : 3000,
			effect:'fold',
			trigger:'click'
		});
	}
	
	function startIndexCarousel(){
		//启动首页轮播
		$('.focusBox').slide({
			titCell:'.num li',
			mainCell:'.pic',
			effect:'fold',
			autoPlay:true,
			trigger:'click',
			startFun:function(i){
				$('.focusBox .txt li').eq(i).animate({'bottom':0}).siblings().animate({'bottom':-36});
			}
		});
	}

	function startMiddleTxt(){
		$('.slideTxtBox').slide();
	}


	function getItemContent(id, callback, errorCb){
		$.ajax({
			type : 'GET',
			url : cgiUrl,
			data : {r:'site/getItemContent', itemId:id, _:+new Date},
			dataType : 'json',
			timeout : 10000,
			success : function(json){
				if(json.ret == 0){
					callback(json.data);
				}else{
					errorCb && errorCb();
				}
			}, 
			error : function(){
				errorCb && errorCb();
			}
		});
	}

	function renderItemContent(id){
		var callback = function(data){
			$('.content').html(data.content);
		};

		getItemContent(id, callback);
	}
	
	function getItems(id, callback, errorCb){
		$.ajax({
			type : 'GET',
			url : cgiUrl,
			data : {r:'site/getItems', moduleId:id, _:+new Date},
			dataType : 'json',
			timeout : 10000,
			success : function(json){
				if(json.ret == 0){
					callback(json.data);
				}else{
					errorCb && errorCb();
				}
			},
			error : function(){
				errorCb && errorCb();
			}
		});
	}

	function renderModuleItems(id){
		var callback = function(data){
			var tpl = '<div class="module_items"><div class="module_items_wrap">'
						+	'<div class="module_pics">'
						+		'<a href="{{url}}" target="_blank"><img src="{{imgUrl}}" /></a>'
						+	'</div>'
						+	'<div class="module_text">'
						+		'<h4><a href="{{url}}" target="_blank">{{name}}</a></h4>'
						+		'<div class="info">{{desc}}</div>'
						+		'<p class="more"><a href="{{url}}" target="_blank">查看详情</a></p>'
						+	'</div>'
						+ '</div></div>',
				arr = [], url = 'index.php?r=site/display&itemId=';

			for(var i = 0; i < data.length; i++){
				arr.push(mustache.render(tpl, {url: url + data[i].id, imgUrl: data[i].url, name: data[i].name, desc: data[i].desc}));
			}

			$('.content').html(arr.join(''));
		};

		var errorCb = function(){
		
		};

		getItems(id, callback, errorCb);
	}

	function renderLinks(id){
		var callback = function(data){
			var tpl = '<li>'
						+ '<span class="date">{{dateStr}}</span>'
						+ '<span class="ico"></span>'
						+ '<a href="{{url}}">{{name}}</a>'
					+ '</li>',
				arr = [], url = 'index.php?r=site/display&itemId=';

			for(var i = 0; i < data.length; i++){
				arr.push(mustache.render(tpl, {name:data[i].name, url:url + data[i].id, dateStr:data[i].dateStr}));
			}

			var contentTpl = '<div class="list"><ul>{{str}}</ul></div>';
			$('.content').html(contentTpl.replace('{{str}}', arr.join('')));
		};

		var errorCb = function(){
		
		};

		getItems(id, callback, errorCb);
	}

	//绑定模块展示页中点击左侧导航链接的行为
	function bindLeftNavLink(){
		$('.middle .side .items a').live('click', function(event){
			var obj = $(this), type = obj.data('showtype'), id = obj.data('key');
			if(type == 2){	//2表示是直接展示内容，1表示读取模块包含的items
				renderItemContent(id);
			}else if(type == 1){	//1表示获取模块内的items 
				renderModuleItems(id);
			}else if(type == 3){	//3表示链接类
				renderLinks(id);
			}
			$('.items').removeClass('on');
			obj.parent().addClass('on');
		});

		$($('.middle .side .items a')[0]).trigger('click');
	}

	function bindQQPop(){
		$('#aFloatTools_Show').on('click', function(){
			$('#divFloatToolsView').animate({width:'show', opacity:'show'}, 'normal', function(){
				$('#divFloatToolsView').show();
				$('#aFloatTools_Show').attr('style', 'display:none');
				$('#aFloatTools_Hide').attr('style', 'display:block');
			});
		});
		$('#aFloatTools_Hide').on('click', function(){
			$('#divFloatToolsView').animate({width:'hide', opacity:'hide'}, 'normal', function(){
				$('#divFloatToolsView').hide();
				$('#aFloatTools_Show').attr('style', 'display:block');
				$('#aFloatTools_Hide').attr('style', 'display:none');
			});
		});
	}

	function bindEvent(){
		bindLeftNavLink();
		bindQQPop();
	}

	function init(){
		//绑定点击事件
		bindEvent();
		//启动公共banner轮播
		startCarousel();
		//启动首页轮播
		startIndexCarousel();
		//启动文字轮播
		startMiddleTxt();
	}

	init();
});
