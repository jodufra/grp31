var users = [];
var WELLCOME_MSG = 'Wellcome to Yahtzee!';

var NotificationsHandler = (function(){
	var NOTIFICATION_NORMAL = 1;
	var NOTIFICATION_GAME = 2;
	var NOTIFICATION_FRIEND = 3;
	var self = {};

	self.checkUser = function(name){
		if(!users[name]){
			users[name] = {count:0, notifications:[]};
			addNotification(name, NOTIFICATION_NORMAL, {type:'info', text:WELLCOME_MSG});
		}
	};

	self.newNotification = function(msg){
		var new_notification;

		if(users[msg.name] && users[msg.name].notifications){
			var note;
			switch(msg.notification.type){
				case NOTIFICATION_NORMAL:
				note = msg.notification.message;
				break;
				case NOTIFICATION_GAME:
				note = msg.notification.game;
				break;
				case NOTIFICATION_FRIEND:
				note = msg.notification.user;
				break;
			}
			var notification = addNotification(msg.name, msg.notification.type, note);
			new_notification = {name:msg.name, notification:notification};
		}else{
			if (msg.notification.type === NOTIFICATION_FRIEND) {
				var invite_target = msg.name;
				var invite_suppliant = msg.notification.user.name;

				var note = {type:'danger', text:'User \''+invite_target+'\' doesn\'t exist or he hasn\'t login since last downtime.'};
				var notification = addNotification(msg.invite_suppliant, NOTIFICATION_NORMAL, note);
				new_notification = {name:invite_suppliant, notification:notification};
			};
		}

		return new_notification;
	};

	self.getNotifications = function(name){
		var notifications = [];
		for(key in users[name].notifications){
			if(users[name].notifications[key]==null){
				continue;
			}
			notifications.push(users[name].notifications[key]);
		}
		return notifications;
	};

	self.dismissNotification = function(name, id){
		delete users[name].notifications[id];
	};

	function addNotification(name, type, note){
		var notification = {};
		notification.id = users[name].count;
		notification.type = type;
		switch(type){
			case NOTIFICATION_NORMAL:
			notification.message = {type:note.type, text:note.text};
			notification.game = null;
			notification.user = null;
			break;
			case NOTIFICATION_GAME:
			notification.message = null;
			notification.game = {owner:note.owner, inviter:note.inviter};
			notification.user = null;
			break;
			case NOTIFICATION_FRIEND:
			notification.message = null;
			notification.game = null;
			notification.user = {id:note.id, name:note.name};
			break;
		}
		users[name].notifications[notification.id] = notification;
		users[name].count++;
		return notification;
	}


	return self;
}());


module.exports.notifications = NotificationsHandler;
module.exports.sio = function(io, socket) {
	socket.on('user:init', function(data){
		NotificationsHandler.checkUser(data.name);
	});

	socket.on('notification_handler:getNotifications', function(data){
		var notifications = NotificationsHandler.getNotifications(data.name);
		socket.emit('notification_handler:getNotifications', {notifications:notifications});
	});

	socket.on('notification_handler:newNotification', function(data){
		var new_notification = NotificationsHandler.newNotification(data);
		io.emit('notification_handler:newNotification', new_notification);
	});

	socket.on('notification_handler:dismissNotification', function(data){
		NotificationsHandler.dismissNotification(data.name, data.id);
		socket.emit('notification_handler:dismissNotification', {id:data.id});
	});

}
