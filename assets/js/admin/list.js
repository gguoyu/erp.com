define(function(require, exports, module){
	var utils = require('utils');
	var mustache = require('mustache');
	var $ = require('jquery');
	require('bootstrap')($);
	var cgiUrl = 'http://www.erp.com/index.php';

	//当前选中的页面id
	var selPageId = 0;

	//绑定事件
	function bindEvent(){
		//添加页面事件绑定
		$('#add_page').on('click', function(){
			$('#addPageModal').modal();
		});
		$('#add_page_save').on('click', function(){
			var page_name = '';
			var page_url  = '';
			
			page_name = $('#page_name').val();
			page_url = $('#page_url').val();

			if(page_name == ''){
				utils.prompt('页面名称不能为空');
				return ;
			}

			if(page_url == '' || !utils.verifyUrl(page_url)){
				utils.prompt('页面url不合法');
			}

			$('#addPageModal').modal('hide');
			$.ajax({
				type : 'POST',
				url : cgiUrl,
				data : {r:'admin/addPage', page_name:page_name, page_url:page_url, _:new Date().getTime()},
				dataType : 'json',
				timeout : 5000,
				success : function(json){
					if(json.ret == 0){
						utils.prompt('添加新页面成功');
						getPageList();
					}else{
						utils.prompt('添加新页面失败');
					}	
				},
				error : function(){
					utils.prompt('添加新页面失败');
				}
			});
		});

		//添加模块事件绑定
		$('#add_module').on('click', function(){
			$('#addModuleModal').modal();
		});
		$('#add_module_save').on('click', function(){
			var page_name = '';
			var page_url  = '';
			
			page_name = $('#page_name').val();
			page_url = $('#page_url').val();

			if(page_name == ''){
				utils.prompt('页面名称不能为空');
				return ;
			}

			if(page_url == '' || !utils.verifyUrl(page_url)){
				utils.prompt('页面url不合法');
			}

			$('#addPageModal').modal('hide');
			$.ajax({
				type : 'POST',
				url : cgiUrl,
				data : {r:'admin/addPage', page_name:page_name, page_url:page_url, _:new Date().getTime()},
				dataType : 'json',
				timeout : 5000,
				success : function(json){
					if(json.ret == 0){
						utils.prompt('添加新页面成功');
						getPageList();
					}else{
						utils.prompt('添加新页面失败');
					}	
				},
				error : function(){
					utils.prompt('添加新页面失败');
				}
			});
		});

		//绑定根据不同页面获取页面中模块等
		$('#sidebar_ul li').live('click', function(e){
			var id = this.id.substring(5);
			$('#sidebar_ul li.active').removeClass('active');
			$(this).addClass('active');
			getModuleList(id);
		});
	}

	//初始化相关
	function init(){
		bindEvent();
		getPageList();
	}

	//获取并展示当前页面列表
	function getPageList(){
		$.ajax({
			type : 'GET',
			url : cgiUrl,
			data : {r:'admin/getPageList', _:new Date().getTime()},
			dataType : 'json',
			success : function(json){
				if(json.ret == 0){
					if(json.data.count > 0){
						var list = json.data.list;
						var tpl = '<li id="page_{{id}}"><a href="javascript:void(0)">{{name}}</a></li>';
						var arr = [];
						for(var i = 0; i < list.length; i++){
							arr.push(mustache.render(tpl, {id:list[i].id, name:list[i].name}));
						}
						$('#sidebar_ul').html(arr.join(''));
					}else{
						$('#sidebar_ul').html('');
					}
				}else{
					utils.prompt('获取页面列表失败');
				}
			},
			error : function(){
				utils.prompt('获取页面列表失败');
			}
		});
	}

	//获取当前页面下的模块列表
	function getModuleList(page_id){
		selPageId = page_id;
	}

	init();
});
