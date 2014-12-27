appServices.factory('PublicChat', function(){
	var self = function(channel){
		return new chat(false, channel, null, false, false, false);
	}
	return self;
});

appServices.factory('PrivateChat', function(){
	var self = function(addressee){
		return new chat(true, null, addressee, true, true, false);
	}
	return self;
});
function chat(privateChat, channel, addressee, init, closable, minimized) {
	this.privateChat = privateChat;
	this.channel = channel;
	this.addressee = addressee;
	this.message = '';
	this.messages = [];
	this.init = init;
	this.closable= closable;
	this.minimized = minimized;
	this.unreadedMessages = 0;
}

appServices.factory('ChatUser', function(){
	var self = function(name, img_src){
		return new chatUser(name, img_src);
	}
	return self;
});
function chatUser(name, img_src) {
	this.name = name;
	this.img_src = img_src;
}