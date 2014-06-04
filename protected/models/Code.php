<?php

/**
 * error code class.
 * defined error code number & msg
 */
class Code
{
	//返回成功
	const SUCCESS = 0;
	//参数缺失
	const NO_PARAMS = 10001;
	//数据库错误
	const DATABASE_ERROR  = 20001;
	//登录失败 
	const LOGIN_ERROR = 30001;
	//退出登录失败
	const LOGOUT_ERROR = 30002;
}
