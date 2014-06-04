<?php
/**
 * @description 普通用户默认访问的控制器
 */
class SiteController extends Controller
{
	/**
	 * 要赋值给视图的默认参数
	 */
	public $params = array();

	/**
	 * 公司名称
	 */
	public $comName = '';
	
	/**
	 * 构造函数，初始化域名等信息
	 */
	public function __construct(){
		//获取当前请求url
		$this->params['url'] = Yii::app()->request->hostInfo . Yii::app()->request->getUrl();
		
		//获取公共导航栏数据
		$this->params['nav'] = YData::getNavData();

		//获取公共轮播图数据
		$this->params['carousel'] = YData::getCarouselData();
	
		$this->comName = Yii::app()->name;
	}

	/**
	 * 网站首页的action
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$conn = Yii::app()->db;
		//此处page_id为2表示首页
		$sql = "SELECT i.id, i.name, i.type, m.name AS module_name, m.id AS module_id, i.url, i.content, i.created FROM module m LEFT JOIN item i ON i.module_id=m.id AND m.page_id=2 AND m.id<>8";
		$result = $conn->createCommand($sql)->queryAll();
		
		$modules = array();
		foreach($result as $value){
			if(!isset($modules[$value['module_id']])){
				$modules[$value['module_id']] = array();
			}
			if(isset($value['created'])){
				$value['dateStr'] = date('Y-m-d', $value['created']);
			}
			$modules[$value['module_id']][] = $value;
		}
	
		//module_id 8 is friendLink
		$sql = "SELECT name, url FROM item WHERE module_id=8";
		$result = $conn->createCommand($sql)->queryAll();

		$friendLink = array();
		if(is_array($result)){
			$friendLink = $result;
		}
		
		$this->params['pageName'] = '网站首页';
		$this->params['pageTitle'] = $this->comName . ' - 网站首页';
		$this->params['modules'] = $modules;
		$this->params['friendLink'] = $friendLink;
		$this->render('site/index', $this->params);
	}

	/**
	 * 关于我们的action
	 */
	public function actionAbout(){
		$conn = Yii::app()->db;

		$sql = "SELECT id, name, 2 AS show_type FROM item WHERE module_id=13";
		$items = $conn->createCommand($sql)->queryAll();

		$this->params['pageName'] = '关于我们';
		$this->params['pageTitle'] = $this->comName . ' - 关于我们';
		$this->params['subNav'] = '首页&nbsp;&gt;&gt;&nbsp;关于我们';
		$this->params['items'] = $items;

		$this->render('site/module', $this->params);
	}

	/**
	 * 产品中心action
	 */
	public function actionProduct(){
		$conn = Yii::app()->db;

		$items = array();
		$sql = "SELECT `id`, `name`, 1 AS show_type FROM module WHERE `page_id`=6";
		$items = $conn->createCommand($sql)->queryAll();

		$this->params['pageName'] = '产品中心';
		$this->params['pageTitle'] = $this->comName . ' - 产品中心';
		$this->params['items'] = $items;
		$this->params['subNav'] = '首页&nbsp;&gt;&gt;&nbsp;产品中心';

		$this->render('site/module', $this->params);
	
	}

	/**
	 * 公司新闻action
	 */
	public function actionNews(){
		$conn = Yii::app()->db;

		$items = array();
		$sql = "SELECT `id`, `name`, 3 AS show_type FROM module WHERE `page_id`=7";
		$items = $conn->createCommand($sql)->queryAll();

		$this->params['pageName'] = '公司新闻';
		$this->params['pageTitle'] = $this->comName . ' - 公司新闻';
		$this->params['items'] = $items;
		$this->params['subNav'] = '首页&nbsp;&gt;&gt;&nbsp;公司新闻';

		$this->render('site/module', $this->params);
	
	}

	/**
	 * 服务中心action
	 */
	public function actionService(){
		$conn = Yii::app()->db;

		$items = array();
		$sql = "SELECT `id`, `name`, 3 AS show_type FROM module WHERE `page_id`=8";
		$items = $conn->createCommand($sql)->queryAll();

		$this->params['pageName'] = '服务中心';
		$this->params['pageTitle'] = $this->comName . ' - 服务中心';
		$this->params['items'] = $items;
		$this->params['subNav'] = '首页&nbsp;&gt;&gt;&nbsp;服务中心';

		$this->render('site/module', $this->params);
	
	}

	/**
	 * 成功案例action
	 */
	public function actionSuccess(){
		$conn = Yii::app()->db;

		$items = array();
		$sql = "SELECT `id`, `name`, 3 AS show_type FROM module WHERE `page_id`=9";
		$items = $conn->createCommand($sql)->queryAll();

		$this->params['pageName'] = '成功案例';
		$this->params['pageTitle'] = $this->comName . ' - 成功案例';
		$this->params['items'] = $items;
		$this->params['subNav'] = '首页&nbsp;&gt;&gt;&nbsp;成功案例';

		$this->render('site/module', $this->params);
		
	}

	/**
	 * 联系我们action
	 */
	public function actionContact(){
		$conn = Yii::app()->db;
		$items = array();

		$sql = "SELECT `id`, `name`, 2 AS show_type FROM item WHERE module_id=13 OR module_id=24 ORDER BY module_id DESC";
		$items = $conn->createCommand($sql)->queryAll();

		$this->params['pageName'] = '联系我们';
		$this->params['pageTitle'] = $this->comName . ' - 联系我们';
		$this->params['subNav'] = '首页&nbsp;&gt;&gt;&nbsp;联系我们';
		$this->params['items'] = $items;

		$this->render('site/module', $this->params);
	
	}

	/**
	 * 展示文章的action
	 */
	public function actionDisplay($itemId){
		$content = array();

		if($itemId != ''){
			$id = intval($itemId);
			$conn = Yii::app()->db;

			$sql = "SELECT i.id, i.name, i.content, i.url, p.name AS p_name, i.created FROM item i, module m, page p WHERE i.module_id = m.id AND m.page_id = p.id AND i.id={$id}";
			
			$content = $conn->createCommand($sql)->queryRow();
			if(!empty($content)){
				$content['dateStr'] = date('Y-m-d', $content['created']);
			}	
		}

		$this->params['pageTitle'] = $this->comName . ' - 查看文章';
		if(!empty($content)){
			$this->params['subNav'] = $content['p_name'] == '网站首页' ? '首页 >> 文章查看' : '首页 >> ' . $content['p_name'];
			$this->params['content'] = $content;
			$this->params['pageName'] = $content['p_name'];
		}else{
			$this->params['pageName'] = '';
			$this->params['subNav'] = '首页 >> 文章查看';
			$this->params['content'] = '';
		}

		$this->render('site/display', $this->params);
	}

	/**
	 * 获取Item内容
	 */
	public function actionGetItemContent($itemId){
		$ret = 0;
		try{
			$content = array();
		
			if($itemId != ''){
				$id = intval($itemId);
				$conn  = Yii::app()->db;

				$sql = "SELECT `id`, `name`, `content`, `desc`, `created` FROM item WHERE `id`={$id}";
				$content = $conn->createCommand($sql)->queryRow();
				if(!empty($content)){
					$content['dateStr'] = date('Y-m-d', $content['created']);
				}
			}
		}catch(Exception $e){
			$ret = -2;
		}
		$this->renderJson($ret, $content);
	}

	/**
	 * 获取module下的items
	 */
	public function actionGetItems($moduleId){
		$ret = 0;
		try{
			$content = array();
			
			if($moduleId != ''){
				$id = intval($moduleId);
				$conn = Yii::app()->db;

				$sql = "SELECT `id`, `name`, `url`, `desc`, `created` FROM item WHERE `module_id`={$id}";
				$content = $conn->createCommand($sql)->queryAll();
				foreach($content as $key => $value){
					$content[$key]['dateStr'] = date('Y-m-d', $value['created']);
				}
			}
		}catch(Exception $e){
			$ret = -2;
		}

		$this->renderJson($ret, $content);
	}

}
