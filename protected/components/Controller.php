<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
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
	 * 以json格式返回数据所需
	 */
	public $data = array(
		'ret' => 0,
		'data' => array(),
		'elapsed' => '0ms',
		'msg' => 'ok',
	);

	/**
	 * 返回json数据
	 */
	public function renderJson($ret = false, $data = array(), $elapsed = '', $msg = ''){
		$endTime = microtime(true);

		if($ret === false){
			$ret = -1;
		}

		$this->data['ret'] = $ret;

		if(!empty($data)){
			$this->data['data'] = $data;
		}

		if($elapsed != ''){
			$this->data['elapsed'] = $elapsed;
		}else{
			$this->data['elapsed'] = round(($endTime - BEGIN_TIME) * 1000, 3) . 'ms';
		}

		if($msg != ''){
			$this->data['msg'] = $msg;
		}

		$this->fetchJson();
	}


	/**
	 * 以json格式输出数据
	 */
	private function fetchJson(){
		$callback = isset($_GET['callback']) ? $_GET['callback'] : '';

		if($callback != '' && !preg_match('/[\w_]+/', $callback)){
			echo 'callback name xss';
			exit;
		}

		header('Content-Type: application/json');

		if($callback){
			echo $callbacl . '(' . @json_ecnode($this->data) . ')';
		}else{
			echo @json_encode($this->data);
		}

		exit;
	}

}
