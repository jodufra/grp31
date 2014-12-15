'use strict';

/* Services */

var appServices = angular.module('appServices', []);

appServices.factory('CurrentUser', function ($http)
{
	var self = {};
	self.player_id;
	self.user_id;
	self.username;
	self.img_src;

	var user = {};
	$http.get( '/player/currentuser' ).
	success(function(data, status, headers, config) {
		self.player_id = data.player_id;
		self.user_id = parseInt(data.user_id);
		self.username = data.username;
		self.img_src = data.img_src;
	}).
	error(function(data, status, headers, config) {
		alert("Server did not respond, please try again");
	});
	return self;
});

// GameService
appServices.factory("GameService", function($http) {
	return {
		getCurrentGames: function() {
			return $http.get('/game/json/currentGames');
		},
		getPlayers: function(gameid) {
			return $http.get('/game/json/'+gameid+'/players');
		},
		getLastMoves: function(gameid) {
			return $http.get('/game/json/'+gameid+'/lastmoves');
		},
		getAllMoves: function(gameid) {
			return $http.get('/game/json/'+gameid+'/allmoves');
		}
	};
});

// FriendListService
appServices.factory("FriendListService", function($http) {
	return {
		getAll: function() {
			return $http.get('/user/friendlist/all');
		},
		getOnline: function() {
			return $http.get('/user/friendlist/online');
		}
	};
});

appServices.provider('GamePlayPlayers', function GamePlayPlayersProvider() {
	var players_count = 10;
	this.players_count = function(count) {
		players_count = count;
	};

	this.$get = function GamePlayPlayersFactory() {
		var players=[];
		for(var i=0; i<players_count; i++){
			players[i] = new GamePlayPlayer(i);
		}
		return players;
	};
});

function GamePlayPlayer(player_num){
	this.id = player_num;
	this.name = 'Player '+player_num;
	this.rollsAvailable = 3;
	this.score = {
		ones:0,
		twos:0,
		threes:0,
		fours:0,
		fives:0,
		sixes:0,
		sum:0,
		bonus:0,
		threeKind:0,
		fourKind:0,
		house:0,
		small_s:0,
		large_s:0,
		chance:0,
		yahtzee:0,
		total:0
	};
	this.r_score = {
		ones:0,
		twos:0,
		threes:0,
		fours:0,
		fives:0,
		sixes:0,
		sum:0,
		bonus:0,
		threeKind:0,
		fourKind:0,
		house:0,
		small_s:0,
		large_s:0,
		chance:0,
		yahtzee:0,
		total:0
	};
	return this;
}