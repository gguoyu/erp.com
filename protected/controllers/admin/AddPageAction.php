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

		if($name == '' || $url == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'name or url missing');
		}

		$params = array(
			'name' => htmlspecialchars($name),
			'url' => htmlspecialchars($url),
			'show' => $show,
			'created' => $start,
			'updated' => 0,
		);

		$sql = "INSERT INTO page(`name`, `url`, `show`, `created`, `updated`) VALUES('{$params['name']}', '{$params['url']}', '{$params['show']}', {$params['created']}, {$params['updated']})";
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
