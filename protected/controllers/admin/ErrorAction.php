<?php
/**
 *@filename: admin/ErrorAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  4/ 7 22:23:36 2014
 */
class ErrorAction extends CAction{
 	public function run(){
		if($error = Yii::app()->errorHandler->error){
			echo $error['message'];
			exit;
		}
	}
 }

