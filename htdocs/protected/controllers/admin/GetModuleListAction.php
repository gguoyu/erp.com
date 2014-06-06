<?php
/**
 *@filename: GetModuleListAction.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 一  3/10 23:46:00 2014
 */
class GetModuleListAction extends CAction{
	public function run(){
		$conn = Yii::app()->db;

		$id = trim($_GET['page_id']);

		if($id == ''){
			$this->controller->renderJson(Code::NO_PARAMS, array(), '', 'page_id missing');
		}

		$sql = "SELECT m.id, m.name, m.img_url, i.id AS item_id, i.content, i.desc, i.module_id, i.type, i.name AS item_name, i.url FROM module m LEFT JOIN item i ON i.module_id = m.id WHERE m.page_id={$id}";
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
				$result = array();
				foreach($list as $value){
					if(!isset($result[$value['id']])){	//如果数据当前没有该id，则先存入id
						$result[$value['id']] = array(
							'id' => $value['id'],
							'name' => $value['name'],
							'itemList' => array(),
						);
					}

					//如果当前已经有id的索引，则将item的元素存入
					if($value['item_id']){
						$result[$value['id']]['itemList'][] = array(
							'id' => $value['item_id'],
							'name' => $value['item_name'],
							'content' => $value['content'],
							'desc' => $value['desc'],
							'url' => $value['url'],
							'type' => $value['type'],
						);
					}
				}
	
				sort($result);
				$data['list'] = $result;
			}
		
			$this->controller->renderJson(Code::SUCCESS, $data, '', 'ok');
		}catch(Exception $e){
			$this->controller->renderJson(Code::DATABASE_ERROR, array(), '', 'query record error');
		}	
	}
}
