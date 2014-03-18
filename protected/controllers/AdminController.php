<?php

class AdminController extends CController
{
	/**
	 * @var array data 返回给前端的数据
	 */
	private $data = array(
		'ret' => 0,
		'data' => array(),
		'elapsed' => '0ms',
		'msg' => 'ok',
	);
	
	/**
	 * 声明action对象，别名对应的action
	 */
	public function actions()
	{
		return array(
			'list' => 'application.controllers.admin.ListAction',
		);
	}
	
	/**
	 * @description 填充返回字段并调用输出函数输出
	 *
	 * @params int $ret 返回码
	 */
	public function renderJson($ret = false, $data = array(), $elapsed = '', $msg = ''){
		if($ret === false){
			throw new UserException('params error');
		}
		
		$this->data['ret'] = $ret;

		if(!empty($data)){
			$this->data['data'] = $data;
		}

		if($elapsed !== ''){
			$this->data['elapsed'] = $elapsed;
		}

		if($msg !== ''){
			$this->data['msg'] = $msg;
		}

		$this->fetchJson();
	}

	/**
	 * @description 以json格式返回数据给前端
	 *
	 * @return null
	 */
	private function fetchJson(){
		$callback = $_GET['callback'];
		
		//todo 需要对callbck进行过滤

		header('Content-Type: application/json');
		if($callback){
			echo $callback . '(' . json_encode($this->data) . ')';
		}else{
			echo json_encode($this->data);
		}
	}
}
