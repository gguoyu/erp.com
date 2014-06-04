<?php
/**
 * 模块layout页面
 */
$this->pageTitle = $this->params['pageTitle'];
?>
<div class="subNav">
	您当前的位置：<?php echo $this->params['subNav']; ?>
</div>
<div class="middle">
	<div class="side">
		<?php foreach($this->params['items'] as $value): ?>
			<div class="items"><a href="javascript:void(0)" data-showType="<?php echo $value['show_type']; ?>" data-key="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></div>
		<?php endforeach; ?>
	</div>
	<div class="content"></div>
</div>
