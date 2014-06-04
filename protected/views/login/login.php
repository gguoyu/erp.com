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
.row{padding-top:50px}
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
				<li class="active"><a href="#">登录</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">关于</a></li>
			</ul>
		</nav>
	</nav>
</header>
<div class="container">
	<div class="row text-left col-md-10">
		<form class="form-horizontal" role="form" method="POST" action="http://www.erp.com/index.php?r=login/index" id="loginForm">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">用户名：</label>
				<div class="col-sm-10">
					<input type="text" maxlength="20" class="form-control" id="name" name="name" placeholder="User Name" />
					<div class="alert alert-warning <?php if(!isset($errorMessage)): ?>hide<?php endif; ?>" id="name_warn">
						<?php if(isset($errorMessage)): ?>
							<?php echo $errorMessage; ?>
						<?php endif; ?>
					</div>
				</div>

			</div>

			<div class="form-group">
				<label for="pass" class="col-sm-2 control-label">密码：</label>
				<div class="col-sm-10">
					<input type="password" maxlength="20" class="form-control" id="pass" name="pass" placeholder="Password" />
					<div class="alert alert-warning hide" id="pass_warn">请输入密码</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="button" id="login_btn" class="btn btn-default">登录</button>
				</div>
			</div>
		</form>	
	</div>
</div>
<footer></footer>



<script type="text/javascript">
seajs.config({
	base : "<?php echo Yii::app()->request->baseUrl; ?>/assets/js/",
	alias : {
		'jquery' : 'jquery.min.js',
		'bootstrap' : 'bootstrap.min.js',
		'utils' : 'utils.js',
		'mustache' : 'mustache.js',
		'login' : 'admin/login.js'
	}
});

seajs.use('login');
</script>
</body>
</html>
