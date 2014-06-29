define(function(require, exports, module){
	var $ = require('jquery');


	//提示语
	function prompt(msg){
		alert(msg);
	}

	//校验url的正确性
	function verifyUrl(url){
return true;
		var strRegex = '^(https|http|ftp|rtsp|mms)?://.*';

		return new RegExp(strRegex).test(url);
	}






	exports.prompt = prompt;
	exports.verifyUrl = verifyUrl;
});
