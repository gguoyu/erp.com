var http = require('http');
var url = require('url');
var fs = require('fs');
http.createServer(function(req, res){
	var data = '';
	req.addListener('data', function(postData){
		data += postData;
	});

	req.addListener('end', function(){
		var post = [], val = '';
		data = data.split('&');
		for(var i = 0; i < data.length; i++){
			val = data[i].split('=');
			post[val[0]] = decodeURIComponent(val[1]);
		}
		var str = post.name + ' said: ' + post.content + "\r\n";
		fs.appendFile('./chat.txt', str, function(err){
			res.writeHead(200, {'Content-Type' : 'application/json'});
			var ret = '';
			if(err){
				ret = {ret:-1, msg:'write file error!'};
			}else{
				ret = {ret:0, msg:'is ok'};
			}

			res.end(JSON.stringify(ret));
		});
	});
}).listen(8002, '127.0.0.1');

console.log('Server running at http://127.0.0.1:8002');
