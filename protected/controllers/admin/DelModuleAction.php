<?php
/**
 *@filename: DelModuleAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class DelModuleAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$id = trim($_POST['module_id']);

		if($id == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'module_id missing');
		}

		$transaction = $conn->beginTransaction();
		try{
			$sql = "DELETE FROM item WHERE module_id={$id}";
			$ret = $conn->createCommand($sql)->execute();

			$sql = "DELETE FROM module WHERE id={$id}";
			$ret = $conn->createCommand($sql)->execute();

			$transaction->commit();

			if($ret > 0){//great than zero means insert sucess
				$ret = 0;
				$msg = 'ok';
			}else{
				$ret = Code::DATABASE_ERROR;
				$msg = 'del data error';
			}
		}catch(Exception $e){
			$transaction->rollBack();
			$ret = Code::DATABASE_ERROR;
			$msg = 'del data error';
		}
		$this->controller->renderJson($ret, array(), '', $msg);
	}
}
