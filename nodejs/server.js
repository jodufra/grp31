var app = require('express')();
var fs = require('fs');
var options = {
	//	key: fs.readFileSync('/home/vagrant/grp31/site/app/keys/server.key'),
	//	cert: fs.readFileSync('/home/vagrant/grp31/site/app/keys/server.crt')
	key: fs.readFileSync('/var/www/html/laravel/app/keys/server.key'),
	cert: fs.readFileSync('/var/www/html/laravel/app/keys/server.crt')
};
var https = require('https').Server(options, app);

var io = require('socket.io')(https);
//var redis = require('socket.io-redis');
//io.adapter(redis({ host: 'localhost', port: 6379 }));

console.log('Yahtzee RT Server started ... Loading Modules:');
exports.io = io;

var chat = require('./routes/chat')(io);
var test = require('./routes/test')(io);

https.listen(3000, function(){
	console.log("Modules loaded. Listening on *:3000");
})