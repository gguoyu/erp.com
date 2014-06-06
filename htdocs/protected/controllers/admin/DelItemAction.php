<?php
/**
 *@filename: DelItemAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class DelItemAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$id = trim($_POST['item_id']);

		if($id == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'item_id missing');
		}
		
		$sql = "DELETE FROM item WHERE id={$id}";
		$command = $conn->createCommand($sql);
		$ret = $command->execute();

		if($ret > 0){//great than zero means insert sucess
			$ret = 0;
			$msg = 'ok';
		}else{
			$ret = Code::DATABASE_ERROR;
			$msg = 'del data error';
		}

		$this->controller->renderJson($ret, array(), '', $msg);
	}
}
