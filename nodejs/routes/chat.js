/* CHAT MODULE */
console.log("Loading Chat Module");

//var io = require('../public').io;
const SOCKETIO_CHAT_EVENT = 'chat:chat';
const SOCKETIO_START_EVENT = 'chat:start';
const SOCKETIO_STOP_EVENT = 'chat:stop';
const CHAT_GLOBAL_CHANNEL = 'global';
const CHAT_BUFFER_SIZE = 3;

var nbOpenSockets = 0;
var isFirstConnectionToChat = true;
var oldChatBuffer = [];


// var discardClient = function() {
// 	console.log('Client disconnected !');
// 	nbOpenSockets--;

// 	if (nbOpenSockets <= 0) {
// 		nbOpenSockets = 0;
// 		console.log("No active clients.");
// 	}
// };

// var handleClient = function(data, socket) {
// 	if (data == true) {
// 		console.log('Client connected !');
		
// 		if (nbOpenSockets <= 0) {
// 			nbOpenSockets = 0;
// 			console.log('First active client.');
// 		}

// 		nbOpenSockets++;

		
// 		if (oldChatBuffer != null && oldChatBuffer.length != 0) {
// 			socket.emit(SOCKETIO_CHAT_EVENT, oldChatBuffer);
// 		}
// 	}
// };

module.exports = function(io) {
// 	io.sockets.on('connection', function(socket) {

// 		socket.on(SOCKETIO_START_EVENT, function(data) {
// 			handleClient(data, socket);
// 		});

// 		socket.on(SOCKETIO_STOP_EVENT, discardClient);

// 		socket.on('disconnect', discardClient);
// 	});
}



// stream.on('connect', function(request) {
// 	console.log('Connected to Twitter API');

// 	if (isFirstConnectionToTwitter) {
// 		isFirstConnectionToTwitter = false;
// 		stream.stop();
// 	}
// });

// stream.on('disconnect', function(message) {
// 	console.log('Disconnected from Twitter API. Message: ' + message);
// });

// stream.on('reconnect', function (request, response, connectInterval) {
//   	console.log('Trying to reconnect to Twitter API in ' + connectInterval + ' ms');
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

console.log("Listening for chat requests");