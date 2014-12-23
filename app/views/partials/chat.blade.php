<div id="chat-wrapper" ng-controller="ChatController">
	<div id="chat" ng-repeat="chat in getChats()" >
		<div ng-if="chat.minimized" class="weight" style="height:332px;width: 100%;"></div>
		<div class="head clearfix">
			<div class="title pull-left">
				<span ng-if="chat.minimized" class="badge" ng-bind="chat.unreadedMessages"></span>
				<span ng-if="!chat.minimized" class="glyphicon glyphicon-comment" aria-hidden="true"></span>
				<span>&nbsp;</span>
				<span ng-if="!chat.channel && !chat.addressee" class="name">Yahtzee Chat</span>
				<span ng-if="chat.channel" class="name" ng-bind="chat.channel"></span>
				<span ng-if="chat.addressee" class="name" ng-bind="chat.addressee"></span>
				<span>&nbsp;&nbsp;&nbsp;</span>
			</div>
			<div class="chat-window-controller pull-right">
				<div ng-if="!chat.minimized" class="chat-controller pull-left" ng-click="chat.minimized = true">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</div>
				<div ng-if="chat.minimized" class="chat-controller pull-left" ng-click="chat.minimized = false">
					<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
				</div>
				<div ng-if="chat.closable" class="chat-controller pull-left" ng-click="closeChat(chat)">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</div>
			</div>		
		</div>
		<div ng-if="!chat.minimized" class="body">
			<div class="message-list">
				<div>
					<div ng-repeat="msg in chat.messages"  class="message clearfix">
						<span class="author">[[msg.user.name]]</span>
						<br>
						<div class="image">
							<img src="[[msg.user.img_src]]" class="portrait img-rounded" alt="">
						</div>
						<div class="text" style="border-color: [[stringToColour(msg.user.name)]] ;">
							<pre><code>[[msg.message]]</code></pre>
						</div>
					</div>
				</div>
			</div>
			<div class="message-typer">
				<form ng-submit="sendMessage(chat)">
					<input class="form-input" autocomplete="off" placeholder="[[user.name]]: Type and press Enter" ng-model="chat.message"/>
				</form>
			</div>
			<div class="loading text-center" ng-if="!chat.init" >
				<h3><strong>Yahtzee Chat</strong></h3>
				<br>
				<p><i class="fa fa-2x fa-spinner fa-spin"></i></p>
			</div>
		</div>
	</div>
</div>