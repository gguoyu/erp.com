<?php

class AdminController extends AController
{
	/**
	 * 声明action对象，别名对应的action
	 */
	public function actions()
	{
		return array(
			'addModule' => 'application.controllers.admin.AddModuleAction',
			'modModule' => 'application.controllers.admin.ModModuleAction',
			'delModule' => 'application.controllers.admin.DelModuleAction',
			'addItem' => 'application.controllers.admin.AddItemAction',
			'modItem' => 'application.controllers.admin.ModItemAction',
			'delItem' => 'application.controllers.admin.DelItemAction',
			'list' => 'application.controllers.admin.ListAction',
			'getPageList' => 'application.controllers.admin.GetPageListAction',
			'getModuleList' => 'application.controllers.admin.GetModuleListAction',
			'addPage' => 'application.controllers.admin.AddPageAction',
			'modPage' => 'application.controllers.admin.ModPageAction',
			'delPage' => 'application.controllers.admin.DelPageAction',
			'error' => 'application.controllers.admin.ErrorAction',
		);
	}

	/**
	 * @description 管理后台需要验证的filter
	 */
	public function filters(){
		return array(
			'login'
		);
	}

	/**
	 * @description 验证登录的filter
	 */
	public function filterLogin($filterChain){
		if(Yii::app()->user->isGuest){
			header('Location: ' . Yii::app()->params['adminLogin']);
		}
		
		$filterChain->run();
	}

}
