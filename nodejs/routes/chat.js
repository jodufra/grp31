/* CHAT MODULE */
function log(str){
	console.log("Chat | "+str);
}
log("Loading Chat Module");

//var io = require('../public').io;
const SOCKETIO_CHAT_EVENT = 'chat:chat';
const SOCKETIO_START_EVENT = 'chat:start';
const SOCKETIO_STOP_EVENT = 'chat:stop';
const CHAT_GLOBAL_CHANNEL = 'global';
const CHAT_BUFFER_SIZE = 5;


var chatBuffer = [];

var message = {author:'', msg:'', channel:''};
var guestCount = 0;
var users = [];

module.exports = function(io, socket) {
	socket.on('chat:innit', function(data){
		if(!data.user || data.user == ''){
			guestCount++
			data.user = 'Guest'+guestCount;
		}
		if(chatBuffer[data.channel]){
			socket.emit('chat:message:buffer', chatBuffer[data.channel]);
		}
		socket.emit('chat:innit', {user: data.user, channel: data.channel});
		socket.broadcast.emit('chat:user:join', {user:data.user, channel:data.channel});

		users[socket.id] = {user:data.user,channel:data.channel};
	});

	socket.on('chat:message:send',function(msg){
		var channel = msg.channel;
		if(typeof chatBuffer[channel] === 'undefined') chatBuffer[channel] = [];
		chatBuffer[channel].push(msg);
		var length = chatBuffer[channel].length 
		if(length >= CHAT_BUFFER_SIZE){
			newBuffer = [];
			for(var i = length-CHAT_BUFFER_SIZE; i<CHAT_BUFFER_SIZE;i++){
				newBuffer.push(chatBuffer[channel][i]);
			}
			chatBuffer[channel] = newBuffer;
		}

		socket.broadcast.emit('chat:message:send', msg);
	});

	socket.on('disconnect', function() {
		if(!(typeof users[socket.id] === 'undefined')){
			var user = users[socket.id].user;
			var channel = users[socket.id].channel;

			socket.broadcast.emit('chat:user:left', user, channel);

			delete users[socket.id];
		}
	});

}





// var discardClient = function() {
// 	log('Client disconnected !');
// 	nbOpenSockets--;

// 	if (nbOpenSockets <= 0) {
// 		nbOpenSockets = 0;
// 		log("No active clients.");
// 	}
// };

// var handleClient = function(data, socket) {
// 	if (data == true) {
// 		log('Client connected !');

// 		if (nbOpenSockets <= 0) {
// 			nbOpenSockets = 0;
// 			log('First active client.');
// 		}

// 		nbOpenSockets++;


// 		if (oldChatBuffer != null && oldChatBuffer.length != 0) {
// 			socket.emit(SOCKETIO_CHAT_EVENT, oldChatBuffer);
// 		}
// 	}
// };





// stream.on('connect', function(request) {
// 	log('Connected to Twitter API');

// 	if (isFirstConnectionToTwitter) {
// 		isFirstConnectionToTwitter = false;
// 		stream.stop();
// 	}
// });

// stream.on('disconnect', function(message) {
// 	log('Disconnected from Twitter API. Message: ' + message);
// });

// stream.on('reconnect', function (request, response, connectInterval) {
//   	log('Trying to reconnect to Twitter API in ' + connectInterval + ' ms');
// });

// stream.on('tweet', function(tweet) {
// 	if (tweet.place == null) {
// 		return ;
// 	}


// 	var msg = {};
// 	msg.text = tweet.text;
// 	msg.location = tweet.place.full_name;
// 	msg.user = {
// 		name: tweet.user.name, 
// 		image: tweet.user.profile_image_url
// 	};



// 	tweetsBuffer.push(msg);

// 	broadcastTweets();
// });

// var broadcastTweets = function() {
	
// 	if (tweetsBuffer.length >= TWEETS_BUFFER_SIZE) {

// 		io.sockets.emit(SOCKETIO_TWEETS_EVENT, tweetsBuffer);

// 		oldChatBuffer = tweetsBuffer;
// 		tweetsBuffer = [];
// 	}
// }

log("Listening for requests");