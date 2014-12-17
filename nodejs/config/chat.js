//var io = require('../public').io;
var CHAT_BUFFER_SIZE = 3;
var SOCKETIO_CHAT_EVENT = 'chat:chat';
var SOCKETIO_START_EVENT = 'chat:start';
var SOCKETIO_STOP_EVENT = 'chat:stop';
var nbOpenSockets = 0;
var isFirstConnectionToChat = true;

console.log("Loading chat module...");

var oldChatBuffer = [];


// var discardClient = function() {
// 	console.log('Client disconnected !');
// 	nbOpenSockets--;

// 	if (nbOpenSockets <= 0) {
// 		nbOpenSockets = 0;
// 		console.log("No active client. Stop streaming from Twitter");
// 		stream.stop();
// 	}
// };

// var handleClient = function(data, socket) {
// 	if (data == true) {
// 		console.log('Client connected !');
		
// 		if (nbOpenSockets <= 0) {
// 			nbOpenSockets = 0;
// 			console.log('First active client. Start streaming from Twitter');
// 			stream.start();
// 		}

// 		nbOpenSockets++;

		
// 		if (oldTweetsBuffer != null && oldTweetsBuffer.length != 0) {
// 			socket.emit(SOCKETIO_TWEETS_EVENT, oldTweetsBuffer);
// 		}
// 	}
// };

// io.sockets.on('connection', function(socket) {

// 	socket.on(SOCKETIO_START_EVENT, function(data) {
// 		handleClient(data, socket);
// 	});

// 	socket.on(SOCKETIO_STOP_EVENT, discardClient);

// 	socket.on('disconnect', discardClient);
// });



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
		
// 		oldTweetsBuffer = tweetsBuffer;
// 		tweetsBuffer = [];
// 	}
// }

//console.log("Listening for chat messages");