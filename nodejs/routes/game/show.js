var http = require('http');
var http_options = function(game_id){
	return {
		rejectUnauthorized: false,
		hostname:'grp31.dad', 
		port:80, 
		path:'/game/game/'+game_id
	}
}

var games = [];
var usersInGame = [];
var onlineUsers = [];
var gio;

var GameManager = (function(){
	var self = {};
	var TIMEOUT_FOR_DISCONNECT = 15000;
	var TIMEOUT_FOR_GAMESTART = 5000;

	self.initGame = function(game_id){
		if(games[game_id] == null){
			http.get(http_options(game_id), function (res) {
				res.setEncoding('utf8');
				res.on('data', function (data) {
					var game = JSON.parse(data);
					if(game.id != undefined){
						games[game_id] = game;
						gio.emit('game:show:gameinit',{game:game});
						setTimeout(function(){ GameManager.startGame(game_id)}, TIMEOUT_FOR_GAMESTART);
					};
				});
			}).on('error', function(e) {
				console.log("http -> /game/game Error: " + e.message);
			});
		}
		return games[game_id];
	}

	self.initUser = function(game_id, user, socketID){
		var index = gamePlayerID(game_id, user.name);
		if(index != -1){
			if(usersInGame[user.name] == null){
				usersInGame[user.name] = games[game_id];

			}else if(usersInGame[user.name].timeouts[user.name]){
				clearTimeout(usersInGame[user.name].timeouts[user.name]);
				delete usersInGame[user.name].timeouts[user.name];
			}

			usersInGame[user.name].players[index].online = true;
			onlineUsers[user.name] = {name:user.name, socketID:socketID};
		}
		return games[game_id];
	}

	self.startGame = function(game_id){
		if(games[game_id]){
			games[game_id].play = true;
			nextTurn(game_id);
			var game = games[game_id];
			gio.emit('game:show:startgame', {game:game});
		}
	};

	self.endTurn = function(game_id){
		if(games[game_id].rounds){
			nextTurn(game_id);
			if(games[game_id].turn == 1){
				games[game_id].rounds--;
			}
		}
	};

	function nextTurn(game_id){
		if(games[game_id]){
			games[game_id].turn++;
			if(games[game_id].turn >= games[game_id].players.length){
				games[game_id].turn = 1;
			}
			for (var i = 0; i < games[game_id].players.length; i++) {
				games[game_id].players[i].rollsAvailable = 0;
				if(games[game_id].players[i].player_num == games[game_id].turn){
					games[game_id].players[i].rollsAvailable = 3;
				}
			};
		}
	}

	self.updateGame = function(game){
		if(games[game.id]){
			games[game.id] = game;
		}
		return games[game.id];
	}

	self.onPlayerDisconnected = function(socketID){
		var username = '';
		for(name in onlineUsers){
			if(onlineUsers[name].socketID == socketID){
				username = name;
				break;
			}
		}
		if(username != '' && usersInGame[username]){
			usersInGame[username].timeouts[username] = {};
			usersInGame[username].timeouts[username].name = username;
			usersInGame[username].timeouts[username].timeout = setTimeout(function(){ GameManager.disconnectPlayer(username)}, TIMEOUT_FOR_DISCONNECT);
			return usersInGame[username];
		}
	};

	self.disconnectPlayer = function(username){
		if(usersInGame[name] && usersInGame[name].timeouts[name]){
			usersInGame[name].players[gamePlayerID(usersInGame[name].id, username)].online = false;
			var game = usersInGame[name];
			delete onlineUsers[name];
			delete usersInGame[name];
			gio.emit('game:show:update', {game:game});
		}
		return null;
	};

	function gamePlayerID(gameID, username){
		if(games[gameID]){
			for (var i = 0; i < games[gameID].players.length; i++) {
				if(games[gameID].players[i].user.name == username){
					return i;
				}
			};
		}
		return -1;
	}


	return self;
}());

module.exports.sio = function(io, socket) {
	gio = io;

	socket.on('game:show:gameinit', function(data){
		var game = GameManager.initGame(data.game_id);
		if(game){
			io.emit('game:show:gameinit',{game:game});
		}
	});

	socket.on('game:show:userinit', function(data){
		var game = GameManager.initUser(data.game_id, data.user, socket.id);
		socket.emit('game:show:userinit',{game:game});
	});

	socket.on('game:show:update', function(data){
		var game = GameManager.updateGame(data.game);
		io.emit('game:show:update',{game:game});
	});

	socket.on('game:show:endturn', function(data){
		var game = GameManager.endTurn(data.game);
		io.emit('game:show:update',{game:game});
	});

	socket.on('disconnect', function(){
		var game = GameManager.onPlayerDisconnected(socket.id);
		if(game){
			io.emit('game:show:update', {game:game});
		}
	});

}