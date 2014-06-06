<?php

class LoginController extends AController
{
	/**
	 * @description 登录action 
	 *
	 * @return null
	 */
	public function actionIndex(){
		if(isset($_POST['name'])){
			$name = $_POST['name'];
			$pass = $_POST['pass'];
			$identity = new UserIdentity($name, $pass);
			if($identity->authenticate()){
				Yii::app()->user->login($identity);
				$this->redirect(Yii::app()->params['adminIndex']);
			}else{
				$this->renderPartial('login', array(
					'errorMessage' => $identity->errorMessage,
				));
			}
		}else{
			if(Yii::app()->user->isGuest){
				$this->renderPartial('login');
			}else{
				$this->redirect(Yii::app()->params['adminIndex']);
			}	
		}
	}

	/**
	 * @description 退出登录action
	 *
	 * @return null
	 */
	public function actionLogout(){
		try{
			Yii::app()->user->logout(true);
			$this->renderJson(Code::SUCCESS, array(), '', 'logout ok');
		}catch(Exception $e){
			$this->renderJson(Code::LOGOUT_ERROR, array(), '', 'logout error');
		}
	}
}
