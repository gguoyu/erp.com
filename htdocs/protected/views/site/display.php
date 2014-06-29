<?php
/**
 * 模块layout页面
 */
?>
<div class="subNav">
	您当前的位置：<?php echo $this->params['subNav']; ?>
</div>
<div class="middle">
	<div class="side">
		<div class="items"><a href="javascript:void(0)" data-key="<?php echo $this->params['content']['id']; ?>">文章正文</a></div>
	</div>
	<div class="content">
		<?php echo !empty($this->params['content']) ? $this->params['content']['content'] : '文章不存在或已删除'; ?>
	</div>
</div>
