<?php
/**
 *@filename: ModModuleAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class ModModuleAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$name = trim($_POST['module_name']);
		$url = trim($_POST['module_url']);
		$id = trim($_POST['module_id']);

		if($name == '' || $id == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'name or module_id missing');
		}

		$params = array(
			'name' => htmlspecialchars($name),
			'url' => htmlspecialchars($url),
			'id' => $id,
			'updated' => $start,
		);

		$sql = "UPDATE module SET `name`='{$params['name']}', `img_url`='{$params['url']}', `updated`={$params['updated']} WHERE id={$params['id']}";

		$command = $conn->createCommand($sql);
		$ret = $command->execute();

		if($ret > 0){//great than zero means insert sucess
			$ret = 0;
			$msg = 'ok';
		}else{
			$ret = Code::DATABASE_ERROR;
			$msg = 'update data error';
		}

		$this->controller->renderJson($ret, array(), '', $msg);
	}
}
