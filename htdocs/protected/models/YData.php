<?php
/**
 *@filename: YData.php
 *@author: birdguo
 *@email: gguoyu@126.com
 *@created: 日  4/13 22:33:06 2014
 */
class YData{

	/**
	 * 获取公共导航栏数据
	 */
	public static function getNavData(){
		$conn = Yii::app()->db;
		$data = array();

		$data = Yii::app()->cache->get('navData');
		if($data === FALSE){
			try{
				$sql = "SELECT `id`, `name`, `url` FROM page WHERE `show`=1 ORDER BY `created`";
				$data = $conn->createCommand($sql)->queryAll();
			}catch(Exception $e){
				$data = array();
			}
			if(count($data)){
				Yii::app()->cache->set('navData', json_encode($data), 86400);
			}
		}else{
			$data = @json_decode($data, true);
			if(!is_array($data)){
				$data = array();
			}
		}
		
		return $data;
	}

	/**
	 * 获取公共轮播图数据
	 */
	public static function getCarouselData(){
		$conn = Yii::app()->db;
		$data = array();

		$data = Yii::app()->cache->get('carouselData');
		if($data === FALSE){
			try{
				$sql = "SELECT i.id, i.name, i.url, i.content FROM item i, module m WHERE i.module_id=m.id AND m.name='轮播图'";
				$data = $conn->createCommand($sql)->queryAll();
			}catch(Exception $e){
				$data = array();
			}
		}else{
			$data = @json_decode($data, true);
			if(!is_array($data)){
				$data = array();
			}
		}

		return $data;
	}

}
