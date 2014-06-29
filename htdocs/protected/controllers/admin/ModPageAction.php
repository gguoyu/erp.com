<?php
/**
 *@filename: ModPageAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class ModPageAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$name = trim($_POST['page_name']);
		$url = trim($_POST['page_url']);
		$show = trim($_POST['page_show']);
		$title = trim($_POST['page_title']);
		$keywords = trim($_POST['page_keywords']);
		$description = trim($_POST['page_description']);
		$id = trim($_POST['page_id']);
		
		if($name == '' || $url == '' || $id == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'name or url or page_id missing');
		}

		if($title == '' || $keywords == '' || $description == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'title or keyword or desc missing');
		}

		$params = array(
			'name' => htmlspecialchars($name),
			'url' => htmlspecialchars($url),
			'show' => $show,
			'id' => $id,
			'updated' => $start,
			'title' => htmlspecialchars($title),
			'keywords' => htmlspecialchars($keywords),
			'description' => htmlspecialchars($description),
		);

		$sql = "UPDATE page SET `name`='{$params['name']}', `url`='{$params['url']}', `show`={$params['show']}, `updated`={$params['updated']}, `title`='{$params['title']}', `keywords`='{$params['keywords']}', `description`='{$params['description']}' WHERE id={$params['id']}";
		
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
