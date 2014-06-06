<?php
/**
 * Controller is the customized admin base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * @param array data ajax返回给前端的数据
	 */
	public $data = array(
		'ret' => 0,
		'data' => array(),
		'elapsed' => '0ms',
		'msg' => 'ok',
	);

	/**
	 * @description 填充返回字段并调用输出函数输出
	 *
	 * @params int $ret 返回码
	 * @params array $data 返回数据
	 * @params string $elapsed 请求消耗时间
	 * @params string $msg 返回说明
	 *
	 * @return null
	 */
	public function renderJson($ret = false, $data = array(), $elapsed = '', $msg = ''){
		$endTime = microtime(true);

		if($ret === false){
			throw new UserException('params error');
		}

		$this->data['ret'] = $ret;

		if(!empty($data)){
			$this->data['data'] = $data;
		}

		if($elapsed !== ''){
			$this->data['elapsed'] = $elapsed;
		}else{
			$this->data['elapsed'] = round(($endTime - BEGIN_TIME) * 1000, 3) . 'ms';
		}

		if($msg !== ''){
			$this->data['msg'] = $msg;
		}

		$this->fetchJson();
	}

	/**
	 * @description 以json或jsonp格式返回数据给前端
	 *
	 * @return null
	 */
	private function fetchJson(){
		$callback = isset($_GET['callback']) ? $_GET['callback'] : '';

		if($callback != '' && !preg_match('/[\w_]+/', $callback)){
			echo 'callback name xss';
			exit;
		}

		header('Content-Type: application/json');
		
		if($callback){
			echo $callback . '(' . @json_encode($this->data) . ')';
			exit;
		}else{
			echo @json_encode($this->data);
			exit;
		}
	}
}
