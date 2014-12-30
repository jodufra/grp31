const CHAT_BUFFER_SIZE = 10;
var publicChatBuffer = [];

/* 
Chat init data layout:
{
	user: name,
	channel: '',
}

Message Layout:
{
	user: {name:'',img_src:''},
	privateChat: false,
	channel: '',
	addressee: '',
	message: '',
}
*/
var chatUsersManager = (function () {
	var users = {};
	var names = {};

	var set = function(socketID, name){
		users[socketID] = setName(name);
		return users[socketID];
	}
	var free = function(socketID){
		freeName(users[socketID]);
		delete users[socketID];
	}

	function setName(oldName){
		var name = oldName;
		if(!oldName || oldName === ''){
			name = getGuestName();
		}else{
			claimName(name);
		}
		return name;
	}

	function claimName (name) {
		if (!name || names[name]) {
			return false;
		} else {
			names[name] = true;
			return true;
		}
	}

	function getGuestName() {
		var name,
		nextUserId = 1;

		do {
			name = 'Guest ' + nextUserId;
			nextUserId += 1;
		} while (!claimName(name));

		return name;
	}

	function freeName(name) {
		if (names[name]) {
			delete names[name];
		}
	}

	return {
		set: set,
		free: free,
	};
}());

function updatePublicChatBuffer(msg){
	var channel = msg.channel;

	if(publicChatBuffer[channel] == undefined) {
		publicChatBuffer[channel] = [];
	}

	publicChatBuffer[channel].push(msg);

	var length = publicChatBuffer[channel].length 

	if(length >= CHAT_BUFFER_SIZE){
		var newBuffer = [];
		for(var i = length-CHAT_BUFFER_SIZE; i<length; i++){
			newBuffer.push(publicChatBuffer[channel][i]);
		}
		publicChatBuffer[channel] = newBuffer;
	}
}


module.exports = function(io, socket) {
	socket.on('chat:init:public', function(data){
		data.user.name = chatUsersManager.set(socket.id, data.user.name);

		if(publicChatBuffer[data.channel] != undefined){
			socket.emit('chat:message:buffer', {channel:data.channel, messages:publicChatBuffer[data.channel]});
		}

		socket.emit('chat:init:public', {user: data.user, channel: data.channel});
	});

	socket.on('chat:message:send',function(msg){
		if(!msg.privateChat){
			updatePublicChatBuffer(msg)
		}
		io.emit('chat:message:receive', msg);
	});

	socket.on('disconnect', function(){
		chatUsersManager.free(socket.id);
	});
}
