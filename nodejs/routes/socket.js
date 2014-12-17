var userNames = (function () {
  var names = {};

  var claim = function (name) {
    if (!name || names[name]) {
      return false;
    } else {
      names[name] = true;
      return true;
    }
  };

  var getGuestName = function () {
    var name,
    nextUserId = 1;

    do {
      name = 'Guest ' + nextUserId;
      nextUserId += 1;
    } while (!claim(name));

    return name;
  };

  var get = function () {
    var res = [];
    for (user in names) {
      res.push(user);
    }

    return res;
  };

  var free = function (name) {
    if (names[name]) {
      delete names[name];
    }
  };

  return {
    claim: claim,
    free: free,
    get: get,
    getGuestName: getGuestName
  };
}());

function onConection(socket) {
  var name = userNames.getGuestName();

  socket.emit('chat:1:init', {
    name: name,
    users: userNames.get()
  });

  socket.broadcast.emit('chat:1:user:join', {
    name: name
  });

  socket.on('chat:1:message:send', function (data) {
    socket.broadcast.emit('chat:1:send:message', {
      user: name,
      text: data.message
    });
  });

  socket.on('chat:1:disconnect', function () {
    socket.broadcast.emit('chat:1:user:left', {
      name: name
    });
    userNames.free(name);
  });
  socket.emit('chat:global:init', {
    name: name,
    users: userNames.get()
  });

  socket.broadcast.emit('chat:global:user:join', {
    name: name
  });

  socket.on('chat:global:message:send', function (data) {
    socket.broadcast.emit('chat:global:send:message', {
      user: name,
      text: data.message
    });
  });

  socket.on('chat:global:disconnect', function () {
    socket.broadcast.emit('chat:global:user:left', {
      name: name
    });
    userNames.free(name);
  });
};
