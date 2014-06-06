var http = require('http');
var url = require('http');
var fs = require('fs');
http.createServer(function(req, res){
	fs.watch('./chat.txt', {persistent:true}, function(event, filename){
		if(event == 'change'){
			fs.readFile('./chat.txt', {encoding:'utf-8', flag:'r'}, function(err, data){
				var ret = 0;
				if(err){
					ret = -1;
					data = '';
				}
				res.writeHead(200, {'Content-Type':'application/json'});
				res.end(JSON.stringify({ret:ret,data:{msg:data}}));
			});
		}
	});
}).listen(8001, '127.0.0.1');

console.log('Server running at http://127.0.0.1:8001');
