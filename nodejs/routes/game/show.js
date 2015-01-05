var Game = function(id, players){
	this.id = id;
	this.turn = '';
	this.players = [];
	for (var i = 0; i < players.length; i++) {
		var player = players[i];
		var name = players[i].name;
		this.players[name] = {};
		this.players[name].user = {id:player.id, user_id:player.user_id, name:player.name, img_src:player.img_src};
		this.players[name].player_num = player.player_num;
		this.players[name].rollsAvailable = (i==0 ? 3 : 0);
		this.players[name].online = false;
		this.players[name].dices = [];
		this.players[name].saved_dices = [];
		this.players[name].score = {
			ones:0, twos:0, threes:0, fours:0, fives:0, sixes:0, sum:0, bonus:0,
			threeKind:0, fourKind:0, house:0, small_s:0, large_s:0, chance:0, yahtzee:0,
			total:0
		};
		this.players[name].r_score = {
			ones:0, twos:0, threes:0, fours:0, fives:0, sixes:0, sum:0, bonus:0,
			threeKind:0, fourKind:0, house:0, small_s:0, large_s:0, chance:0, yahtzee:0,
			total:0
		};
	};
	this.timeouts = [];
}
var games = [];
var usersInGame = [];
var onlineUsers = [];
var gio;

var GameManager = (function(){
	var self = {};
	/*
	self.init = function(game, user, socketID){
		if(user){
			if(games[game.id] == null){
				games[game.id] = new Game(game.id, game.players);
			}
			if(games[game.id].players[user.name] != null){
				usersInGame[user.name] = games[game.id];
				if(usersInGame[user.name].timeouts[user.name]){
					clearTimeout(usersInGame[name].timeouts[name]);
					delete usersInGame[name].timeouts[name];
				}
				usersInGame[user.name].players[user.name].online = true;
				onlineUsers[user.name] = {name:user.name, socketID:socketID};
			}
		}else if(games[game.id] != null){
			return games[game.id];
		}else{
			return null;
		}
	};
	*/

	self.getGame = function(name){

	};

	self.onPlayerDisconnected = function(socketID){

	};


	return self;
}());

module.exports.sio = function(io, socket) {
	gio = io;

	socket.on('game:show:init', function(data){
		GameManager.init(data.game, data.user, socket.id);
		var game = GameManager.getGame(data.user.name);
		socket.emit('game:show:init', {game:game});
		socket.broadcast.emit('game:show:update', {game:game});
	});



	socket.on('disconnect', function(){
		var game = GameManager.onPlayerDisconnected(socket.id);
		if(game){
			io.emit('game:create:update', {game:game});
		}
	});

}