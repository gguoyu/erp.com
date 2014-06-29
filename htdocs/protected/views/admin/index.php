<DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理后台</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/docs.css" media="screen" />
<style type="text/css">
.mod_page,.del_page,.mod_upd,.mod_del,.item_add{margin-left:10px}
.item_upd,.item_del{margin-left:10px;}
</style>
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">ERP</a>	
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
				<li class="active"><a href="javascript:void(0)">管理后台</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="javascript:void(0)" id="log_out" title="退出"><?php echo Yii::app()->user->name; ?></a></li>
				<li><a href="javascript:void(0)">关于</a></li>
			</ul>
		</nav>
	</nav>
</header>
<div class="container bs-docs-container">
	<div class="row">
		<div class="col-md-3">
			<div class="bs-sidebar hidden-print affix" role="complementary">
				<ul class="nav">
					<li><a href="javascript:void(0)" id="add_page">+添加新页面</a></li>
				</ul>
				<ul class="nav bs-sidenav" id="sidebar_ul"></ul>
			</div>
		</div>
		<div class="col-md-9" role="main">
			<div class="bs-docs-section">
				<p>&nbsp;</p>
				<p><a href="javascript:void(0)" id="add_module">+添加新模块</a><a href="javascript:void(0)" id="del_page" class="del_page pull-right">-删除页面</a><a href="javascript:void(0)" id="mod_page" class="mod_page pull-right">-修改页面</a></p>
				<div class="bs-example" id="module_list">
					
				</div>
			</div>	
		</div>
	</div>
</div>
<footer></footer>


<!-- add page model start -->
<div class="modal fade" id="addPageModal" tabindex="-1" role="dialog" aria-labelledby="addPageModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">添加页面</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="page_name" class="col-sm-2 control-label">页面名称</label>
						<div class="col-sm-10">
							<input type="text" maxlength="40" class="form-control" id="page_name" placeholder="标题" />
						</div>
					</div>
					<div class="form-group">
						<label for="page_url" class="col-sm-2 control-label">页面url</label>
						<div class="col-sm-10">
							<input type="text" maxlength="255" class="form-control" id="page_url" placeholder="网址" />
						</div>
					</div>
					<div class="form-group">
						<label for="page_title" class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="page_title" placeholder="页面标题" />
						</div>
					</div>
					<div class="form-group">
						<label for="page_description" class="col-sm-2 control-label">描述</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="page_description" placeholder="页面描述" />
						</div>
					</div>
					<div class="form-group">
						<label for="page_keywords" class="col-sm-2 control-label">关键词</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="page_keywords" placeholder="页面关键词" />
						</div>
					</div>
					<div class="form-group">
						<label for="page_show" class="col-sm-2 control-label">是否展示页面</label>
						<div class="col-sm-10">
							<select class="form-control" id="page_show">
								<option value="0">否</option>
								<option value="1">是</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<input type="button" id="add_page_save" class="btn btn-primary" value="添加" />
			</div>
		</div>
	</div>
</div>
<!-- add page model end -->

<!-- add module model start -->
<div class="modal fade" id="addModuleModal" tabindex="-1" role="dialog" aria-labelledby="addPageModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">添加模块</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="module_name" class="col-sm-2 control-label">模块名称</label>
						<div class="col-sm-10">
							<input type="text" maxlength="40" class="form-control" id="module_name" placeholder="模块名称" />
						</div>
					</div>
					<div class="form-group">
						<label for="module_url" class="col-sm-2 control-label">模块配图</label>
						<div class="col-sm-10">
							<input type="text" maxlength="255" class="form-control" id="module_url" placeholder="模块配图" />
						</div>
					</div>
					<input type="hidden" id="module_id" />
				</form>
			</div>
			<div class="modal-footer">
				<input type="button" id="add_module_save" class="btn btn-primary" value="添加" />
			</div>
		</div>
	</div>
</div>
<!-- add module modal end -->

<!-- add item modal start -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:830px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">添加Item</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="item_name" class="col-sm-2 control-label">Item名称</label>
						<div class="col-sm-10">
							<input type="text" maxlength="60" class="form-control" id="item_name" placeholder="Item名称" />
						</div>
					</div>
					<div class="form-group">
						<label for="item_type" class="col-sm-2 control-label">Item类型</label>
						<div class="col-sm-10">
							<select id="item_type" class="form-control">
								<option value="1">内容</option>
								<option value="2">链接</option>
								<option value="3">图片</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="item_link" class="col-sm-2 control-label">链接地址</label>
						<div class="col-sm-10">
							<input type+"text" maxlength="255" class="form-control" id="item_link" placeholder="链接地址" />
						</div>
					</div>
					<div class="form-group">
						<label for="item_title" class="col-sm-2 control-label">页面标题</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="item_title" placeholder="页面标题" />
						</div>
					</div>
					<div class="form-group">
						<label for="item_keywords" class="col-sm-2 control-label">页面关键词</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="item_keywords" placeholder="页面关键词" />
						</div>
					</div>
					<div class="form-group">
						<label for="item_description" class="col-sm-2 control-label">页面描述</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="item_description" placeholder="页面描述" />
						</div>
					</div>
					<div class="form-group">
						<label for="item_desc" class="col-sm-2 control-label">Item描述</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="item_desc" placeholder="内容摘要" />
						</div>
					</div>
					<div class="form-group">
						<label for="item_content" class="col-sm-2 control-label">Item内容</label>
						<div class="col-sm-10">
							<textarea id="item_content" name="item_content" class="form-control"></textarea>
						</div>
					</div>
					<input type="hidden" id="item_id" />
					<input type="hidden" id="item_module_id" />
				</form>
			</div>
			<div class="modal-footer">
				<input type="button" id="add_item_save" class="btn btn-primary" value="添加" />
			</div>
		</div>
	</div>
</div>
<!-- add item modal end -->

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/keditor/kindeditor-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/keditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/sea.js"></script>
<script type="text/javascript">
seajs.config({
	base : "<?php echo Yii::app()->request->baseUrl; ?>/assets/js/",
	alias : {
		'jquery' : 'jquery.min.js',
		'bootstrap' : 'bootstrap.min.js',
		'utils' : 'utils.js',
		'mustache' : 'mustache.js',
		'list' : 'admin/list.js'
	}
});

seajs.use('list');
</script>
</body>
</html>
