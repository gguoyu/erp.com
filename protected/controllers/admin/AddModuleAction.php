<?php
/**
 *@filename: AddModuleAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class AddModuleAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$name = trim($_POST['module_name']);
		$url = trim($_POST['module_url']);
		$pageId = trim($_POST['page_id']);

		if($name == '' || $pageId == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'name or page_id missing');
		}

		$params = array(
			'name' => htmlspecialchars($name),
			'url' => htmlspecialchars($url),
			'page_id' => $pageId,
			'created' => $start,
			'updated' => 0,
		);

		$sql = "INSERT INTO module(`name`, `page_id`, `img_url`, `created`, `updated`) VALUES('{$params['name']}', {$params['page_id']}, '{$params['url']}', {$params['created']}, {$params['updated']})";
		$command = $conn->createCommand($sql);
		$ret = $command->execute();

		if($ret > 0){//great than zero means insert sucess
			$ret = 0;
			$msg = 'ok';
		}else{
			$ret = Code::DATABASE_ERROR;
			$msg = 'insert data error';
		}

		$this->controller->renderJson($ret, array(), '', $msg);
	}
}
