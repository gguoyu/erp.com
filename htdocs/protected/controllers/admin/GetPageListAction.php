<?php
/**
 *@filename: GetPageListAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class GetPageListAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;
		$sql = "SELECT `id`, `name`, `url`, `show`, `title`, `keywords`, `description`, `created`, `updated` FROM page";
		try{
			$command = $conn->createCommand($sql);
			$list = $command->queryAll();
			$data = array(
				'count' => 0,
				'list' => array(),
			);

			$count = count($list);
			$data['count'] = $count;
			if($count){
				$data['list'] = $list;
			}

			$this->controller->renderJson(Code::SUCCESS, $data, '', 'ok');
		}catch(Exception $e){
			$this->controller->renderJson(Code::DATABASE_ERROR, array(), '', 'query record error');
		}	
	}
}
