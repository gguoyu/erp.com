define(function(require, exports, module){
	var $ = require('jquery');

	$('#login_btn').on('click', function(){
		var name = $('#name').val().trim();
		var pass = $('#pass').val().trim();

		$('#name_warn,#pass_warn').addClass('hide');

		if(name == ''){
			$('#name_warn').html('请输入用户名').removeClass('hide');
			return;
		}

		if(pass == ''){
			$('#pass_warn').removeClass('hide');
			return;
		}

		$('#loginForm').submit();
	});

	$('body').on('keyup', function(e){
		if(e.keyCode == 13){
			$('#login_btn').trigger('click');
		}
	});
});
