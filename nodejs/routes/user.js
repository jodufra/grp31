var TIMEOUT_DISCONNECT = 7500;

var onlineUsers = [];
var offlineTempUsers = [];

var usersManager = (function(){

	var self = {};
	var um_io;

	self.connectUser = function(name, socketID){
		setUser(name, socketID, true);
		console.log('Conected User - '+name);
	};

	self.temporaryDisconnectUser = function(io, socketID){
		createTimeout(io, socketID);
	};

	self.reconnectUser = function(name, socketID){
		setUser(name, socketID, true);
		destroyTimeout(name)
	};

	self.disconnectUser = function(io, name){
		setUser(name, null, false);
		delete offlineTempUsers[name];
		io.emit('user:disconnect',{name:name});
		console.log('Disconnected User - '+name);
	};

	self.checkStates = function(users){
		var states = [];
		for (var i = 0; i < users.length; i++) {
			var user = users[i];
			if(onlineUsers[user] !== undefined){
				states.push({name:user, online:onlineUsers[user].online});
			}else{
				states.push({name:user, online:false});
			}
		};
		return states;
	};

	function setUser(name, socketID, online){
		onlineUsers[name] = {name:name, socketID:socketID, online:online};
	}

	function createTimeout(io, socketID){
		um_io = io;
		var user;
		for(key in onlineUsers){
			var user = onlineUsers[key];
			if(user.socketID == socketID){
				offlineTempUsers[user.name] = setTimeout(function(){
					usersManager.disconnectUser(um_io, user.name);
				}, TIMEOUT_DISCONNECT);
				break;
			}
		}
	}

	function destroyTimeout(name){
		clearTimeout(offlineTempUsers[name]);
		delete offlineTempUsers[name];
	}

	return self;
}());



module.exports.sio = function(io, socket) {
	socket.on('user:init', function(data){
		var name = data.name;
		if(onlineUsers[name] && onlineUsers[name].online){
			usersManager.reconnectUser(name, socket.id);
		}else{
			usersManager.connectUser(name, socket.id)
		}
		io.emit('user:init', {name:name});
	});

	socket.on('user:states', function(data){
		var users = usersManager.checkStates(data.users);
		socket.emit('user:states', {users:users});
	});

	socket.on('disconnect', function(){
		usersManager.temporaryDisconnectUser(io, socket.id);
	});
}
