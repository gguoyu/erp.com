<?php
/**
 * 首页的layout文件
 */
?>
<div class="mainContent">
	<div class="focusBox">
		<ul class="pic" style="position:relative;width:320px;height:240px">
			<?php foreach($this->params['modules'][5] as $key => $value): //moduleid 5 means left carousel?>
				<li style="position:absolute;width:320px;left:0;top:0;display:<?php if($key == 0): ?>list-item<?php else: ?>none<?php endif; ?>"><a href="index.php?r=site/display&itemId=<?php echo $value['id']; ?>" target="_blank"><img src="<?php echo $value['url']; ?>"></a></li>
			<?php endforeach; ?>
		</ul>
		<div class="txt-bg"></div>
		<div class="txt">
			<ul>
				<?php foreach($this->params['modules'][5] as $key => $value): ?>
					<li><a href="index.php?r=site/display&itemId=<?php echo $value['id']; ?>"><?php echo $value['name'];?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<ul class="num">
			<?php foreach($this->params['modules'][5] as $key => $value): ?>
				<li><a><?php echo $key + 1; ?></a><span></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="slideTxtBox">
		<div class="hd">
			<ul>
				<li><a href="javascript:void(0)"><?php echo $this->params['modules'][10][0]['module_name']; ?></a></li>
				<li><a href="javascript:void(0)"><?php echo $this->params['modules'][11][0]['module_name']; ?></a></li>
				<li><a href="javascript:void(0)"><?php echo $this->params['modules'][12][0]['module_name']; ?></a></li>
			</ul>
		</div>
		<div class="bd">
			<ul>
				<?php foreach($this->params['modules'][10] as $key => $value): ?>
					<li>
						<span class="date"><?php echo date('Y-m-d', $value['created']); ?></span>
						<a href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['name']; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<ul>
				<li><?php echo $this->params['modules'][11][0]['content']; ?></li>
			</ul>
			<ul>
				<li><?php echo $this->params['modules'][12][0]['content']; ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="side">
	<div id="txtMarqeeTop" class="sideBox">
		<div class="hd"><h3>通知公告</h3></div>
		<div class="bd">
			<div class="tempWrap" style="overflow:hidden;position:relative;height:168px">
				<ul style="height:384px;position:relative;padding:0px;margin:0px;">
					<?php foreach($this->params['modules'][9] as $key => $value): ?>
						<li><span><?php echo $value['dateStr']; ?></span><a href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['name']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>	
		</div>
	</div>
</div>
<div class="friendLink">
	<ul>
		<li>友情链接：</li>
		<?php foreach($this->params['friendLink'] as $key => $value): ?>
			<li><a href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['name']; ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>
