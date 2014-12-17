var express = require('express');
var https = require('https');
var fs = require('fs');
var app = express();
var options = {
	//	key: fs.readFileSync('/home/vagrant/grp31/site/app/keys/server.key'),
	//	cert: fs.readFileSync('/home/vagrant/grp31/site/app/keys/server.crt')
	key: fs.readFileSync('/var/www/html/laravel/app/keys/server.key'),
	cert: fs.readFileSync('/var/www/html/laravel/app/keys/server.crt')
};
var server = https.createServer(options, app).listen(3000);

var io = require('socket.io').listen(server);
var redis = require('socket.io-redis');
io.adapter(redis({ host: 'localhost', port: 6379 }));

console.log('Yahtzee RT Server started ... Loading Modules:');
exports.io = io;
var chat = require('./routes/chat');
var test = require('./routes/test');

chat(io);
test(io);