const CHAT_BUFFER_SIZE = 10;

var publicChatBuffer = [];
var message = {author:'', msg:'', channel:''};
var guestCount = 0;

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

function setUserName(name){
	var newName;
	if(!data.user || data.user == ''){
		guestCount++;
		newName = 'Guest'+guestCount;
	}else{
		newName = name;
	}
	return newName;
}

function updatePublicChatBuffer(msg){
	var channel = msg.channel;

	if(typeof publicChatBuffer[channel] === 'undefined') {
		publicChatBuffer[channel] = [];
	}

	publicChatBuffer[channel].push(msg);

	var length = publicChatBuffer[channel].length 

	if(length >= CHAT_BUFFER_SIZE){
		newBuffer = [];
		for(var i = length-CHAT_BUFFER_SIZE; i<CHAT_BUFFER_SIZE; i++){
			newBuffer.push(publicChatBuffer[channel][i]);
		}
		publicChatBuffer[channel] = newBuffer;
	}
}


module.exports = function(io, socket) {
	socket.on('chat:init:public', function(data){
		data.user = setUserName(data.user);

		if(publicChatBuffer[data.channel]){
			socket.emit('chat:message:buffer', publicChatBuffer[data.channel]);
		}

		socket.emit('chat:init:public', {user: data.user, channel: data.channel});
	});

	socket.on('chat:message:send',function(msg){
		if(!msg.privateChat){
			updatePublicChatBuffer(msg)
		}
		io.emit('chat:message:receive', msg);
	});

}
