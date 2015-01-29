var app = require('express')();
var http = require('http').Server(app);

var io = require('socket.io')(http);

console.log('Yahtzee RT Server started ...');
exports.io = io;


io.on('connection', function(socket) {
	//	console.log('Connected - '+ socket.id);

	require('./routes/user').sio(io, socket);
	require('./routes/chat').sio(io, socket);
	require('./routes/notification_handler').sio(io, socket);
	require('./routes/game/create').sio(io, socket);
	require('./routes/game/show').sio(io, socket);

	socket.on('disconnect', function() {
		//	console.log('Disconnected - '+ socket.id);
	});
});

http.listen(3000, function(){
	console.log("Listening on *:3000");
})