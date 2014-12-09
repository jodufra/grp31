var express = require('express'),
    https = require('https')
    fs = require('fs');

var options = {
  key: fs.readFileSync('/home/vagrant/grp31/site/app/keys/server.key'),
  cert: fs.readFileSync('/home/vagrant/grp31/site/app/keys/server.crt')
};

var server = https.createServer(options, app);

var app = express();

const redis =   require('redis');
const io =      require('socket.io');
const client =  redis.createClient();

server.listen(3000, 'localhost');
console.log("Listening.....");

io.listen(server).on('connection', function(client) {
    const redisClient = redis.createClient();

    redisClient.subscribe('users.update');

    console.log("Redis server running.....");

    redisClient.on("message", function(channel, message) {
        console.log(message);
        client.emit(channel, message);
    });

    client.on('disconnect', function() {
        redisClient.quit();
    });
});