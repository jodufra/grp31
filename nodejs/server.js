var express = require('express');
var bodyparser = require('body-parser');
var morgan = require('morgan');
var app = express();
var server = app.listen(3000);
var io = require('socket.io').listen(server);
var redis = require('socket.io-redis');
io.adapter(redis({ host: 'localhost', port: 6379 }));

exports.io = io;

console.log('Yahtzee started on port ' + server.address().port);


app.use(bodyparser);
app.use(morgan);

app.all('*', function(req, res, next) {
    res.set('Access-Control-Allow-Origin', '*');
    res.set('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT');
    res.set('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type');
    if ('OPTIONS' == req.method) return res.send(200);
    next();
});


var chat = require('./config/chat');