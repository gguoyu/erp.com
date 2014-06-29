<?php
/**
 *@filename: AddPageAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class AddPageAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		//start timestamp
		$start = time();

		$name = trim($_POST['page_name']);
		$url = trim($_POST['page_url']);
		$show = trim($_POST['page_show']);
		$title = trim($_POST['page_title']);
		$keywords = trim($_POST['page_keywords']);
		$description = trim($_POST['description']);

		if($name == '' || $url == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'name or url missing');
		}
		
		if($title == '' || $keywords == '' || $description == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'title or keyword or desc missing');
		}

		$params = array(
			'name' => htmlspecialchars($name),
			'url' => htmlspecialchars($url),
			'show' => $show,
			'created' => $start,
			'updated' => 0,
			'title' => htmlspecialchars($title),
			'keywords' => htmlspecialchars($keywords),
			'description' => htmlspecialchars($description),
		);

		$sql = "INSERT INTO page(`name`, `url`, `show`, `title`, `keywords`, `description`, `created`, `updated`) VALUES('{$params['name']}', '{$params['url']}', '{$params['show']}', '{$params['title']}', '{$params['keywords']}', '{$params['description']}', {$params['created']}, {$params['updated']})";
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
