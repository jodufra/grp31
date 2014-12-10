'use strict';

/* Services */

var appServices = angular.module('appServices', []);

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
		get: function() {
			return $http.get('/user/json/friendlist');
		}
	};
});

appServices.value('player_initial_score', {
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
}
);

appServices.provider('Players', function PlayersProvider() {
	var players_count = 10;
	this.players_count = function(count) {
		players_count = count;
	};

	this.$get = ['player_initial_score',function PlayersFactory(player_initial_score) {
		var players=[];
		for(var i=0; i<players_count; i++){
			players.push(new Player(i, player_initial_score));
		}
		return players;
	}];
});

function Player(player_num, player_initial_score){
	this.id = player_num;
	this.num = player_num;
	this.name = 'Player '+player_num;
	this.rollsAvailable = 3;
	this.score = player_initial_score;
	this.r_score = player_initial_score;
	return this;
}