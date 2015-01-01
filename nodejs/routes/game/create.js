var NotificationsHandler = require('../notification_handler').notifications;
var rooms = [];
var usersInRoom = [];
var onlineUsers = [];

var RoomManager = (function(){
	var self = {};
	var TIMEOUT_DISCONNECT = 7500;

	self.init = function(user, socketID){
		var name = user.name;
		if(usersInRoom[name] == null){
			createRoom(user);
		}else {
			destroyTimeout(name);
		}
		connectUser(user, socketID);

	};

	self.getRoom = function (name) {
		var room = {};

		room.leader = usersInRoom[name].leader;
		room.players=[];
		room.invited=[];
		room.timeouts=[];

		for(key in usersInRoom[name].players){
			room.players.push(usersInRoom[name].players[key]);
		}
		for(key in usersInRoom[name].invited){
			room.invited.push(usersInRoom[name].invited[key]);
		}
		for(key in usersInRoom[name].timeouts){
			room.timeouts.push(usersInRoom[name].timeouts[key]);
		}

		return room;
	};

	self.removePlayer = function(leader, player){
		removePlayer(leader, player);
		if(!(player.id < 10)){
			delete onlineUsers[name];
		}
	};

	self.addBot = function(leader, player){
		rooms[leader].players[player.name] = player;
		rooms[leader].players[player.name].online = true;
		usersInRoom[player.name] = rooms[leader];
	};

	self.removeBot = function(leader){
		var id = -1;
		var name = '';
		for(p_name in rooms[leader].players){
			var p_id = rooms[leader].players[p_name].id;
			if(p_id < 10 && id < p_id){
				id = p_id;
				name = p_name;
			}
		}
		delete rooms[leader].players[name];
	};

	self.removeAllBots = function(leader, player){
		var bots = [];
		for(key in usersInRoom[leader].players){
			if(usersInRoom[leader].players[key].id < 10){
				delete usersInRoom[leader].players[key];
			}
		}
	};

	self.onPlayerLeave = function(leader, player){
		removePlayer(leader, player);
		delete rooms[leader].invited[player.name];
		delete onlineUsers[player.name];
	};

	self.onPlayerDisconnected = function(io, socketID){
		createTimeout(io, socketID);
	};

	self.disconnectPlayer = function(io, name){
		if(usersInRoom[name].leader == name){
			RoomManager.terminate(name);
			io.emit('user:disconnect',{name:name});
		}else{
			usersInRoom[name].invited[name] = "waiting";
			delete usersInRoom[name].players[name];
			delete usersInRoom[name];
			delete onlineUsers[name];
		}
	};

	self.addQueue = function(leader){
	};

	self.removeQueue = function(leader){
	};

	self.addInvited = function(leader, name){
		var user = {state:'waiting', name:name};
		rooms[leader].invited[name] = user;
		return rooms[leader];
	};

	self.acceptInvite = function(leader, user){
		if(usersInRoom[user.name]){
			rooms[leader].invited[user.name].state = 'declined';
			return 'busy';
		}
		if(rooms[leader] == null){
			return 'unavailable';
		}
		var isNotInvited = true;
		for(name in rooms[leader].invited){
			if(name == user.name){
				isNotInvited = false;
				break;
			}
		}
		if(isNotInvited){
			return 'unavailable';
		}
		var players_count = 0;
		var max_bot_id = -1;
		for(name in rooms[leader].players){
			if(rooms[leader].players[name].id < 10 && max_bot_id < rooms[leader].players[name].id){
				max_bot_id = rooms[leader].players[name].id;
			}
			players_count++;
		}
		if(players_count == 10){
			if(max_bot_id != -1){
				RoomManager.removeRobot(leader);
				players_count--;
			}
		}
		if(players_count < 10){
			rooms[leader].invited[user.name].state = 'accepted';
			rooms[leader].players[user.name] = user;
			usersInRoom[user.name] = rooms[leader];
			return 'ok';
		}else{
			rooms[leader].invited[user.name].state = 'full';
			return 'full';
		}
	};

	self.declineInvite = function(leader, name){
		rooms[leader].invited[name].state = 'declined';
	};

	self.terminate = function(leader){
		for(name in rooms[leader].players){
			delete usersInRoom[name];
			delete onlineUsers[name];
		}
		delete rooms[leader];
	};

	function removePlayer(leader, player){
		delete onlineUsers[player.name]
		delete rooms[leader].players[player.name];
		usersInRoom[player.name] = null;
	} 

	function removeRobot(leader, id){
		for(key in rooms[leader].players){
			var player = rooms[leader].players[key];
			if(player.id == id){
				delete rooms[leader].players[key];
				break;
			}
		}
	} 

	function connectUser(user, socketID){
		usersInRoom[user.name].players[user.name].online = true;
		onlineUsers[user.name] = {name:user.name, socketID:socketID};
	}

	function destroyTimeout(name){
		if(usersInRoom[name].timeouts[name]){
			clearTimeout(usersInRoom[name].timeouts[name]);
			delete usersInRoom[name].timeouts[name];
		}
	}

	function createTimeout(io, socketID){
		var user = null;
		for(name in onlineUsers){
			if(onlineUsers[name].socketID == socketID){
				user = onlineUsers[name];
				break;
			}
		}
		if(user != null){
			usersInRoom[user.name].players[user.name].online = false;
			usersInRoom[user.name].timeouts[user.name] = setTimeout(function(){ RoomManager.disconnectPlayer(io, user.name)}, TIMEOUT_DISCONNECT);
		}
	}

	function createRoom(user){
		rooms[user.name] = {leader: user.name, players:[], invited:[], timeouts:[]};
		rooms[user.name].players[user.name] = user;
		usersInRoom[user.name] = rooms[user.name];
	}

	return self;
}());



module.exports.sio = function(io, socket) {
	socket.on('game:create:init', function(data){
		RoomManager.init(data.user, socket.id);
		var room = RoomManager.getRoom(data.user.name);
		socket.emit('game:create:init', {room:room});
		socket.broadcast.emit('game:create:update', {room:room});
	});

	socket.on('game:create:removeplayer', function(data){
		RoomManager.removePlayer(data.leader, data.player);
		var note = {type:'danger', text:'You were kicked out of the game room.'};
		var notification = {id:0, type:1, message:note};
		var new_notification = {name:data.player.name, notification:notification};
		new_notification = NotificationsHandler.newNotification(new_notification);

		socket.emit('game:create:removeplayer', {name:data.player.name});
		socket.emit('notification_handler:newNotification', new_notification);
		io.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:addbot', function(data){
		RoomManager.addBot(data.leader, data.player);
		io.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:removebot', function(data){
		RoomManager.removeBot(data.leader);
		io.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:removeallbots', function(data){
		RoomManager.removeAllBots(data.leader);
		io.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:addqueue', function(data){
		//	RoomManager.addQueue(data.leader);
		io.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:removequeue', function(data){
		//	RoomManager.removeQueue(data.leader);
		io.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:addinvited', function(data){
		RoomManager.addInvited(data.leader, data.name);
		io.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:acceptinvite', function(data){
		var result = RoomManager.acceptInvite(data.leader, data.player);
		if(result  != 'ok'){
			if (result == 'busy') {
				var note = {type:'warning', text:'Can\'t join a room while in another.'};
			}if(result == 'full'){
				var note = {type:'warning', text:'Unfortunately that room is already full.'};
			}if(result == 'unavailable'){
				var note = {type:'warning', text:'That room is already closed.'};
			}
			var new_notification = NotificationsHandler.newNotification({name:data.player.name, notification:{id:0, type:1, message:note}});
			socket.emit('notification_handler:newNotification', new_notification);
			if(result != 'unavailable'){
				socket.broadcast.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
			}
		} else{
			socket.emit('game:create:acceptinvite', {name:data.player.name});
			socket.broadcast.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
		}
	});

	socket.on('game:create:declineinvite', function(data){
		RoomManager.declineInvite(data.leader, data.name);
		socket.broadcast.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:leave', function(data){
		RoomManager.onPlayerLeave(data.leader, data.player);
		socket.broadcast.emit('game:create:update', {room:RoomManager.getRoom(data.leader)});
	});

	socket.on('game:create:terminate', function(data){
		RoomManager.terminate(data.leader);
		io.emit('game:create:terminate', {leader:data.leader});
	});

	socket.on('game:create:start', function(data){
		RoomManager.terminate(data.leader);
		io.emit('game:create:start', {leader:data.leader, game_id:data.game_id});
	});

	socket.on('disconnect', function(){
		RoomManager.onPlayerDisconnected(io, socket.id);
	});
}