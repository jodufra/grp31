// Current User and Player
appServices.service('currentUser', function($http){
	return $http.get( '/player/currentuser' );
});

// Player
appServices.factory('Player', function(){
	var self = function(id, user_id, name, img_src){
		return new player(id, user_id, name, img_src);
	}
	return self;
});
function player(id, user_id, name, img_src) {
	this.id = id;
	this.user_id = user_id;
	this.name = name;
	this.img_src = img_src;
}

// Game Playing Player
appServices.factory('GamePlayPlayer', function() {
	var self = function(id, user_id, name, img_src, player_num){
		return new gamePlayPlayer(id, user_id, name, img_src, player_num);
	}
	return self;
});
function gamePlayPlayer(id, user_id, name, img_src, player_num) {
	this.id = id;
	this.user_id = user_id;
	this.name = name;
	this.img_src = img_src;
	this.player_num = player_num;
	this.rollsAvailable = 3;
	this.score = {
		ones:0, twos:0, threes:0, fours:0, fives:0, sixes:0, sum:0, bonus:0,
		threeKind:0, fourKind:0, house:0, small_s:0, large_s:0, chance:0, yahtzee:0,
		total:0
	};
	this.r_score = {
		ones:0, twos:0, threes:0, fours:0, fives:0, sixes:0, sum:0, bonus:0,
		threeKind:0, fourKind:0, house:0, small_s:0, large_s:0, chance:0, yahtzee:0,
		total:0
	};
}