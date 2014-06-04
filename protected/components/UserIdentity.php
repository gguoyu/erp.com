<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 *
	 */
	private $salt = 'GYgy123test';
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$conn = Yii::app()->db;
		$pass  = md5($this->password . $this->salt);
		$sql = "SELECT COUNT(`id`) AS cnt FROM user WHERE name='{$this->username}' AND pass='{$pass}'";
		
		try{
			$ret = $conn->createCommand($sql)->queryRow();
			$this->errorCode = (isset($ret['cnt']) && $ret['cnt'] > 0) ? Code::SUCCESS : Code::DATABASE_ERROR;
		}catch(Exception $e){
			$this->errorCode = Code::DATABASE_ERROR;
		}

		$this->errorMessage = $this->errorCode == 0 ? '' : '用户名或密码错误';

		return !$this->errorCode;
	}
}
