/* Test MODULE */
function log(str){
	console.log("Test | "+str);
}

log("Loading Module");
var request_count = 0;

module.exports = function(io) {
	io.sockets.on('connection', function(socket) {
		log('client connected')
		socket.on('request', function(data) {
			log('recieved request')
			request_count++;
			socket.broadcast.emit('response', request_count);
		});
		socket.on('disconnect', function() {
			log('client disconnected!');
		});
	});
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

log("Listening for requests");