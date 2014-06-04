<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="header">
	<div class="logoBar">
		<h1><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.gif" /><div class="rinfo"></div></h1>
	</div>
	<div class="navBar">
		<ul class="nav clearfix">
			<?php if(is_array($this->params['nav'])): ?>
				<?php foreach($this->params['nav'] as $key => $value): ?>
					<li class="m<?php if((strpos($this->params['url'], $value['url']) !== FALSE) || ($value['name'] == $this->params['pageName'])): ?> on<?php endif; ?>"><h3><a href="<?php echo $value['url']; ?>"><?php echo $value['name'];?></a></h3></li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
<div class="banner" id="myCarousel">
	<div class="bd">
		<ul>
			<?php foreach($this->params['carousel'] as $key => $value): ?>
				<li style="background-size:980px;background-repeat:no-repeat no-repeat;background-position:50% 0px;background-image:url(<?php echo Yii::app()->request->baseUrl . '/images/' . $value['content']; ?>)" <?php if($key != 0): ?>style="display:none"<?php endif; ?>>
					<a href='<?php echo $value['url']; ?>' target="_blank"></a>
				</li>
			<?php endforeach?>
		</ul>
	</div>
	<div class="hd">
		<ul>
			<?php foreach($this->params['carousel'] as $key => $value): ?>
				<li <?php if($key == 0): ?>class="on"<?php endif; ?>><?php echo $key; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div><!-- banner -->
<div class="midContent">
	<div class="siteWidth">
		<?php echo $content; ?>
	</div>
</div>
<div id="footer">
	<div class="copyRight">
		<p>Copyright&copy;2014 粤ICP备12051140号-1 深圳品衡迪科技有限公司</p>
		<p>地址：深圳市宝安区前进一路128号亚尼斯大厦5楼503（西乡国税对面）</p>
		<p>电话：86-755-23226080</p>
	</div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/sea.js"></script>
<script type="text/javascript">
seajs.config({
	base : "<?php echo Yii::app()->request->baseUrl; ?>/assets/js/",
	alias : {
		'jquery' : 'jquery.min.js',
		//'bootstrap' : 'bootstrapv2.min.js',
		'bootstrap' : 'bootstrap.js',
		'utils' : 'utils.js',
		'superslide' : 'jquery.SuperSlide.2.1.1.js',
		'index' : 'index.js'
	}
});

seajs.use('index');
</script>

<div id="floatTools" class="float0831">
	<div class="floatL">
		<a style="display:none" href="javascript:void(0)" id="aFloatTools_Show" class="btnOpen" title="查看在线客服">展开</a>
		<a href="javascript:void(0)" id="aFloatTools_Hide" class="btnCtn">收缩</a>
	</div>
	<div id="divFloatToolsView" class="floatR">
		<div class="tp"></div>
		<div class="cn">
			<ul>
				<li><span class="icoZx">在线咨询</span></li>
				<li><a class="icoTc" target="_blank" href="tencent://message/?uin=289284916&site=www.phdkj.com&menu=yes">技术支持1</a></li>
				<li><a class="icoTc" target="_blank" href="tencent://message/?uin=1253690937&site=www.phdkj.com&menu=yes">技术支持2</a></li>
				<li><a class="icoTc" target="_blank" href="tencent://message/?uin=45336358&site=www.pdhkj.com&menu=yes">业务王生</a></li>
				<li class="bot"><a class="icoTc" target="_blank" href="tencent://message/?uin=441010598&site=www.phdkj.com&menu=yes">业务杨生</a></li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fa4f2438831fde6e405ae70f5989121ac' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>
