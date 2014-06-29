define(function(require, exports, module){
	var utils = require('utils');
	var mustache = require('mustache');
	var $ = require('jquery');
	require('bootstrap')($);
	var cgiUrl = 'index.php';

	//对页面的操作方式
	var modPage = 'add'; //add or mod

	//当前选中的页面列表
	var selPageList = null;

	//当前选中的页面id
	var selPageId = 0;

	//当前选中的页面的模块列表
	var selModulList = null;

	//对模块的操作方式
	var modOperate = 'add';	//add or mod

	//对Item的操作方式
	var modItem = 'add'; //add or mod

	//keditor
	var editor = KindEditor.create('textarea[name=item_content]', {
		width : '480px',
		height : '300px'
	});

	//绑定页面操作事件
	function bindPageEvent(){
		//弹出添加页面浮层事件绑定
		$('#add_page').on('click', function(){
			modPage = 'add';
			$('#add_page_save').val('添加');
			$('#page_name,#page_url,#page_title,#page_keywords,#page_description').val('');
			$('#addPageModal').modal();
		});

		//添加或修改页面事件绑定
		$('#add_page_save').on('click', function(){
			var page_name = $('#page_name').val();
			var page_url  = $('#page_url').val();
			var page_show = $('#page_show').val();
			var page_title = $('#page_title').val();
			var page_keywords = $('#page_keywords').val();
			var page_description = $('#page_description').val();
			var r = '';
			var str = '';
			var data = {};
			
			r = modPage == 'add' ? 'admin/addPage' : 'admin/modPage';
			str = modPage == 'add' ? '添加新' : '修改';

			if(page_name == ''){
				utils.prompt('页面名称不能为空');
				return ;
			}

			if(page_url == '' || !utils.verifyUrl(page_url)){
				utils.prompt('页面url不合法');
				return ;
			}

			if(modPage == 'mod'){
				if(selPageId == ''){
					utils.prompt('页面ID不存在');
					return;
				}
				data['page_id'] = selPageId;
			}

			if(page_title == ''){
				utils.prompt('页面标题不能为空');
				return;
			}

			if(page_description == ''){
				utils.prompt('页面描述不能为空');
				return;
			}

			if(page_keywords == ''){
				utils.prompt('页面关键词不能为空');
				return;
			}

			data['r'] = r;
			data['page_name'] = page_name;
			data['page_url'] = page_url;
			data['page_show'] = page_show;
			data['page_keywords'] = page_keywords;
			data['page_title'] = page_title;
			data['page_description'] = page_description;
			data['_'] = new Date().getTime();

			$('#addPageModal').modal('hide');
			$.ajax({
				type : 'POST',
				url : cgiUrl,
				data : data,
				dataType : 'json',
				timeout : 5000,
				success : function(json){
					if(json.ret == 0){
						utils.prompt(str + '页面成功');
						getPageList();
					}else{
						utils.prompt(str + '页面失败');
					}	
				},
				error : function(){
					utils.prompt(str + '页面失败');
				}
			});
		});

		//修改页面弹出浮层事件绑定
		$('#mod_page').on('click', function(e){
			if(selPageId == 0){
				utils.prompt('请先选择要修改的页面');
				return;
			}

			modPage = 'mod';
			var page = getPage();
			
			$('#add_page_save').val('修改');
			$('#page_name').val(page.name);
			$('#page_url').val(page.url);
			$('#page_show').val(page.show);
			$('#page_title').val(page.title);
			$('#page_keywords').val(page.keywords);
			$('#page_description').val(page.description);
			$('#addPageModal').modal();
		});

		//删除页面事件绑定
		$('#del_page').on('click', function(e){
			if(selPageId == 0){
				utils.prompt('请先选择页面');
				return ;
			}
			if(confirm('删除页面之后无法恢复，确认删除？')){
				$.ajax({
					type : 'POST',
					url : cgiUrl,
					data : {r:'admin/delPage', page_id:selPageId, _:new Date().getTime()},
					dataType : 'json',
					timeout : 5000,
					success : function(json){
						if(json.ret == 0){
							utils.prompt('删除页面成功');
							getPageList();
						}else{
							utils.prompt('删除页面失败');
						}
					},
					error : function(){
						utils.prompt('删除页面失败');
					}
				});
			}	
		});
	}

	//绑定模块操作事件
	function bindModuleEvent(){
		//弹出添加模块浮层事件绑定
		$('#add_module').on('click', function(){
			if(selPageId == 0){
				return ;
			}
			modOperate = 'add';
			$('#add_module_save').val('添加');
			$('#module_name,#module_url').val('');
			$('#addModuleModal').modal();
		});

		//添加或修改模块事件绑定
		$('#add_module_save').on('click', function(){
			var module_name = '';
			var module_url  = '';
			var module_id = '';
			var r = modOperate == 'add' ? 'admin/addModule' : 'admin/modModule';
			var str = modOperate == 'add' ? '添加新' : '修改';
			var data = {};

			module_name = $('#module_name').val();
			module_url = $('#module_url').val();
			
			if(modOperate == 'mod'){
				module_id = $('#module_id').val();
				if(module_id == ''){
					utils.prompt('模块id不存在');
					return;
				}
				data['module_id'] = module_id;
			}else{
				data['page_id'] = selPageId;
			}

			if(module_name == ''){
				utils.prompt('模块名称不能为空');
				return;
			}

			if(module_url != '' && !utils.verifyUrl(module_url)){
				utils.prompt('模块配图url不合法');
				return;
			}

			data['r'] = r;
			data['module_name'] = module_name;
			data['module_url'] = module_url;
			data['_'] = new Date().getTime();

			$('#addModuleModal').modal('hide');
			$.ajax({
				type : 'POST',
				url : cgiUrl,
				data : data,
				dataType : 'json',
				timeout : 5000,
				success : function(json){
					if(json.ret == 0){
						utils.prompt(str + '模块成功');
						getModuleList(selPageId);
					}else{
						utils.prompt(str + '模块失败');
					}	
				},
				error : function(){
					utils.prompt(str + '模块失败');
				}
			});
		});

		//修改模块浮层弹出代理事件
		$('#module_list a.mod_upd').live('click', function(e){
			var index = $(this).attr('index');
			var module = typeof selModuleList[index] != 'undefined' ? selModuleList[index] : null;
			if(module){
				modOperate = 'mod';
				$('#add_module_save').val('修改');
				$('#module_name').val(module.name);
				$('#module_url').val(module.img_url);
				$('#module_id').val(module.id);
				$('#addModuleModal').modal();
			}else{
				utils.prompt('模块id不存在');
			}
		});
		
		//删除模块代理事件
		$('#module_list a.mod_del').live('click', function(e){
			var index = $(this).attr('index');
			var module = typeof selModuleList[index] != 'undefined' ? selModuleList[index] : null;

			if(!module){
				utils.prompt('模块不存在');
				return;
			}

			if(confirm('模块删除后无法恢复，确认删除？')){ 
				$.ajax({
					type : 'POST',
					url : cgiUrl,
					data : {r:'admin/delModule', module_id:module.id, _:new Date().getTime()},
					dataType : 'json',
					timeout : 5000,
					success : function(json){
						if(json.ret == 0){
							utils.prompt('模块删除成功');
							getModuleList(selPageId);
						}else{
							utils.prompt('删除模块失败');
						}
					},
					error : function(){
						utils.prompt('删除模块失败');
					}
				});
			}
		});

		//绑定根据不同页面获取页面中模块等
		$('#sidebar_ul li').live('click', function(e){
			var id = this.id.substring(5);
			$('#sidebar_ul li.active').removeClass('active');
			$(this).addClass('active');
			getModuleList(id);
		});
	
	}

	//绑定item操作事件
	function bindItemEvent(){
		//模块内新增item代理事件
		$('#module_list a.item_add').live('click', function(e){
			var obj = $(this), index = obj.attr('index');
			var module = selModuleList[index];
			
			modItem = 'add';
			$('#add_item_save').val('添加');
			$('#item_module_id').val(module.id);
			$('#item_name,#item_url,#item_content,#item_desc,#item_title,#item_description,#item_keywords').val('');
			editor.html('');
			$('#addItemModal').modal();		
		});

		//模块内修改item代理事件
		$('#module_list a.item_upd').live('click', function(e){
			var obj = $(this), index = obj.attr('index'), 
				itemIndex = obj.attr('itemIndex');

			var item = selModuleList[index].itemList[itemIndex];

			modItem = 'upd';
			$('#add_item_save').val('修改');
			$('#item_name').val(item.name);
			//$('#item_content').val(item.content);
			editor.html(item.content);
			$('#item_desc').val(item.desc);
			$('#item_link').val(item.url);
			$('#item_id').val(item.id);
			$('#item_type').val(item.type);
			$('#item_title').val(item.title);
			$('#item_keywords').val(item.keywords);
			$('#item_description').val(item.description);
			$('#addItemModal').modal();
		});

		//模块内删除item代理事件
		$('#module_list a.item_del').live('click', function(e){
			var obj = $(this), index = obj.attr('index'), itemIndex = obj.attr('itemIndex');
			var item = selModuleList[index].itemList[itemIndex];

			if(confirm('删除Item之后无法恢复，确认删除？')){
				$.ajax({
					type : 'POST',
					url : cgiUrl,
					data : {r:'admin/delItem', item_id:item.id},
					dataType : 'json',
					timeout: 5000,
					success : function(json){
						if(json.ret == 0){
							utils.prompt('删除Item成功');
							getModuleList(selPageId);
						}else{
							utils.prompt('删除Item失败');
						}
					},
					error : function(){
						utils.prompt('删除Item失败');
					}
				});
			}
		});

		//新增或者修改Item内容
		$('#add_item_save').on('click', function(e){
			var item_name = $('#item_name').val();
			//var item_content = $('#item_content').val();
			var item_content = editor.html();
			var item_desc = $('#item_desc').val();
			var item_type = $('#item_type').val();
			var item_link = $('#item_link').val();
			var item_title = $('#item_title').val();
			var item_keywords = $('#item_keywords').val();
			var item_description = $('#item_description').val();
			var item_id = $('#item_id').val();
			var item_module_id = $('#item_module_id').val();
			var r = modItem == 'add' ? 'admin/addItem' : 'admin/modItem';
			var str = modItem == 'add' ? '添加新' : '修改';
			var data = {};

			if(item_name == ''){
				utils.prompt('Item名称不能为空');
				return;
			}

			if(item_type == ''){
				utils.prompt('Item类型不能为空');
				return;
			}

			if(item_type == 1){
				if(item_content == ''){
					utils.prompt('Item内容不能为空');
					return;
				}
			}else{
				if(item_link == '' || !utils.verifyUrl(item_link)){
					utils.prompt('Item链接不合法');
					return;
				}
			}

			if(modItem == 'upd'){
				if(item_id == ''){
					utils.prompt('Item Id不能为空');
					return;
				}
				data['item_id'] = item_id;
			}else{
				if(item_module_id == ''){
					utils.prompt('Module Id不能为空');
					return;
				}
				data['module_id'] = item_module_id;
			}

			if(item_title == ''){
				utils.prompt('页面标题不能为空');
				return;
			}

			if(item_keywords == ''){
				utils.prompt('页面关键词不能为空');
				return;
			}

			if(item_description == '页面描述不能为空'){
				utils.prompt('');
				return;
			}

			data['r'] = r;
			data['item_name'] = item_name;
			data['item_content'] = item_content;
			data['item_desc'] = item_desc;
			data['item_type'] = item_type;
			data['item_link'] = item_link;
			data['item_title'] = item_title;
			data['item_keywords'] = item_keywords;
			data['item_description'] = item_description;
			data['_'] = new Date().getTime();

			$('#addItemModal').modal('hide');
			$.ajax({
				type : 'POST',
				url : cgiUrl,
				data : data,
				dataType : 'json',
				timeout : 5000,
				success : function(json){
					if(json.ret == 0){
						utils.prompt(str + 'Item成功');
						getModuleList(selPageId);
					}else{
						utils.prompt(str + 'Item失败');
					}
				},
				error : function(){
					utils.prompt(str + 'Item失败');
				}
			});
		});
	}

	//绑定退出登录事件 
	function bindLogOut(){
		$('#log_out').on('click', function(e){
			$.ajax({
				type : 'GET',
				url : cgiUrl,
				data : {r:'login/logout', _:new Date().getTime()},
				dataType : '',
				timeout : 5000,
				success : function(json){
					if(json.ret == 0){
						location.href = 'index.php?r=login/index';
					}else{
						utils.prompt('退出登录失败');
					}
				},
				error : function(){
					utils.prompt('退出登录失败');
				}
			});
		});
	}	

	//绑定事件
	function bindEvent(){
		bindPageEvent();
		bindModuleEvent();
		bindItemEvent();
		bindLogOut();
	}

	//初始化相关
	function init(){
		bindEvent();
		getPageList();
	}

	//根据页面id获取当前页面信息
	function getPage(){
		for(var i = 0; i < selPageList.length; i++){
			if(selPageList[i].id == selPageId){
				return selPageList[i];
			}
		}
		
		return {name:'',url:''}
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
					selPageId = 0;
					if(json.data.count > 0){
						var list = json.data.list;
						selPageList = list;
						var tpl = '<li id="page_{{id}}"><a href="javascript:void(0)">{{name}}</a></li>';
						var arr = [];
						for(var i = 0; i < list.length; i++){
							arr.push(mustache.render(tpl, {id:list[i].id, name:list[i].name}));
						}
						$('#sidebar_ul').html(arr.join(''));
						$('#module_list').html('');
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

		$.ajax({
			type : 'GET',
			url : cgiUrl,
			data : {r:'admin/getModuleList', page_id: page_id, _:new Date().getTime()},
			dataType : 'json',
			success : function(json){
				if(json.ret == 0){
					if(json.data.count > 0){
						var list = json.data.list;
						selModuleList = list;	//保存当前模块及元素内容列表
						var tpl = '<p>{{name}}<a href="javascript:void(0)" class="mod_del pull-right" index="{{index}}">-删除模块</a><a href="javascript:void(0)" class="mod_upd pull-right" index="{{index}}">-修改模块</a><a href="javascript:void(0)" class="item_add pull-right" index="{{index}}">+新增Item</a></p>'
									+ '<table class="table table-bordered"><thead>'
									+ '<tr><th>item Id</th><th>item名称</th><th>item类型</th><th>item内容</th><th>操作</th></tr></thead>'
									+ '<tbody>';
						var itemTpl = '<tr><td>{{itemId}}</td><td>{{name}}</td><td>{{type}}</td><td>{{content}}</td><td><a href="javascript:void(0)" index="{{index}}" itemIndex="{{itemIndex}}" class="item_upd">修改</a><a href="javascript:void(0)" index="{{index}}" itemIndex="{{itemIndex}}" class="item_del">删除</a></td></tr>';
						var arr = [], itemArr, itemStr = '', item, type = {1:'内容', 2:'链接', 3:'图片'};

						for(var i = 0; i < list.length; i++){
							item = list[i].itemList;
							itemStr = '';
							if(item && item.length > 0){
								itemArr = [];
								for(var j = 0; j < item.length; j++){
									itemArr.push(mustache.render(itemTpl, {
										itemId : item[j].id,
										moduleId : list[i].id,
										name : item[j].name,
										content : item[j].type == 1 ? item[j].content.substring(0, 50): item[j].url,
										desc : item[j].desc,
										type : type[item[j].type],
										index : i,
										itemIndex : j,
									}));
								}
								itemStr = itemArr.join('');
							}
							arr.push(mustache.render(tpl, {
								name : list[i].name,
								index : i
							}) + itemStr + '</tbody></table><hr />');
						}
						$('#module_list').html(arr.join(''));
					}else{
						selModuleList = [];
						$('#module_list').html('');
					}
				}else{
					selModuleList = [];
					utils.prompt('获取模块列表失败');
				}
			},
			error : function(){
				utils.prompt('获取模块列表失败');
			}
		});
	}

	init();
});
