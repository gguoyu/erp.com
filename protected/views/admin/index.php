<DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理后台</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/docs.css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/sea.js"></script>
<style type="text/css">

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
				<li class="active"><a href="#">首页</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">登录</a></li>
				<li><a href="#">关于</a></li>
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
				<p><a href="javascript:void(0)" id="add_module">+添加新模块</a></p>
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
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="add_page_save" class="btn btn-primary">添加</button>
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
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="add_module_save" class="btn btn-primary">添加</button>
			</div>
		</div>
	</div>
</div>
<!-- add page model end -->




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
