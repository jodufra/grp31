var rooms = [];

var RoomManager = (function(){
	var self = {};
	
	
	
	self.connectUser = function(name, socketID){
		setUser(name, socketID, true);
		console.log('Conected User - '+name);
	};

	return self;
}());



module.exports = function(io, socket) {
	socket.on('game:create:init', function(data){


		var name = data.name;
		if(onlineUsers[name] && onlineUsers[name].online){
			usersManager.reconnectUser(name, socket.id);
		}else{
			usersManager.connectUser(name, socket.id)
		}
		io.emit('user:init', {name:name});
	});

	socket.on('disconnect', function(){
		usersManager.temporaryDisconnectUser(io, socket.id);
	});
}
