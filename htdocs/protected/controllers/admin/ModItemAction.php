<?php
/**
 *@filename: ModItemAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class ModItemAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$id = trim($_POST['item_id']);
		$name = trim($_POST['item_name']);
		$type = trim($_POST['item_type']);
		$url = trim($_POST['item_link']);
		$content = trim($_POST['item_content']);
		$desc = trim($_POST['item_desc']);

		if($name == '' || $type == '' || $id == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'name or type or id missing');
		}
		
		if($type == 1 && $content == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'content missing');
		}else if($type != 1 && $url == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'item link missing');
		}

		$params = array(
			'id' => $id,
			'name' => htmlspecialchars($name),
			'type' => htmlspecialchars($type),
			'url' => $url,
			'content' => $content,
			'desc' => $desc,
			'updated' => $start,
		);

		$sql = "UPDATE item SET `name`='{$params['name']}', `type`={$params['type']}, `url`='{$params['url']}', `content`='{$params['content']}', `desc`='{$params['desc']}', `updated`={$params['updated']} WHERE id={$params['id']}";
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
