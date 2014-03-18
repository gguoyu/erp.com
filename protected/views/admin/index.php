<DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理后台</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/sea.js"></script>
</head>
<body>
<header>
	<nav class="navbar" role="navigation">
		<div class="navbar-header">
			
		</div>
	</nav>
</header>
<div class="container"></div>
<footer></footer>
<script type="text/javascript">
seajs.config({
	base : "<?php echo Yii::app()->request->baseUrl; ?>/assets/js/",
	alias : {
		'jquery' : 'jquery.min.js',
		'bootstrap' : 'bootstrap.min.js',
		'list' : 'admin/list.js'
	}
});

seajs.use('list');
</script>
</body>
</html>
