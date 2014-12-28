const NOTIFICATION_NORMAL = 1;
const NOTIFICATION_GAME = 2;
const NOTIFICATION_FRIEND = 3;

appServices.factory('NotificationNormal', function(){
	var self = function(id, message_type, message_text){
		return new notification(id, NOTIFICATION_NORMAL, message_type, message_text, null, null, null, null);
	}
	return self;
});

appServices.factory('NotificationGame', function(){
	var self = function(id, game_owner, game_inviter){
		return new notification(id, NOTIFICATION_GAME, null, null, game_owner, game_inviter, null, null);
	}
	return self;
});

appServices.factory('NotificationFriend', function(){
	var self = function(id, user_id, user_name){
		return new notification(id, NOTIFICATION_FRIEND, null, null, null, null, user_id, user_name);
	}
	return self;
});

function notification(id, type, message_type, message_text, game_owner, game_inviter, user_id, user_name) {
	this.id = id;
	this.type = type;
	switch(type){
		case NOTIFICATION_NORMAL:
		this.message = {type:message_type, text:message_text};
		this.game = null;
		this.user = null;
		break;
		case NOTIFICATION_GAME:
		this.message = null;
		this.game = {owner:game_owner, inviter:game_inviter};
		this.user = null;
		break;
		case NOTIFICATION_FRIEND:
		this.message = null;
		this.game = null;
		this.user = {id:user_id, name:user_name};
		break;
	}
}