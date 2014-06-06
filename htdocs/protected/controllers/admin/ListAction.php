<?php
/**
 *@filename: HelloAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class ListAction extends CAction{
	public function run(){
		$this->controller->renderPartial('index');
	}
}
