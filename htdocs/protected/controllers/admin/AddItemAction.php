<?php
/**
 *@filename: AddItemAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class AddItemAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$name = trim($_POST['item_name']);
		$type = trim($_POST['item_type']);
		$url = trim($_POST['item_link']);
		$content = trim($_POST['item_content']);
		$desc = trim($_POST['item_desc']);
		$moduleId = trim($_POST['module_id']);

		if($name == '' || $type == '' || $moduleId == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'name or type or module_id missing');
		}
		
		if($type == 1 && $content == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'content missing');
		}else if($type != 1 && $url == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'item link missing');
		}

		$params = array(
			'name' => htmlspecialchars($name),
			'type' => htmlspecialchars($type),
			'url' => $url,
			'content' => $content,
			'desc' => $desc,
			'module_id' => $moduleId,
			'created' => $start,
			'updated' => 0,
		);

		$sql = "INSERT INTO item(`name`, `module_id`, `type`, `url`, `content`, `desc`, `created`, `updated`) VALUES('{$params['name']}', {$params['module_id']}, {$params['type']}, '{$params['url']}', '{$params['content']}', '{$params['desc']}', {$params['created']}, {$params['updated']})";
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
