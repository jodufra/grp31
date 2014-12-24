<div id="chat-wrapper" ng-controller="ChatController">
	<div id="chat" class="col-md-3 col-md-offset-9" >
		<div class="head clearfix">
			<div class="title pull-left">
				<span class="badge">[[unreadedMessages]]</span>
				<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
				<span ng-if="!channel" class="name">&nbsp;Yahtzee Chat</span>
				<span ng-if="channel" class="name">&nbsp;[[channel]]</span>
				&nbsp;&nbsp;&nbsp;
			</div>
			<div class="close pull-right" ng-click="toogleChatState()">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</div>		
		</div>
		<div class="body">
			<div class="messageslist">
				<div>
					<div ng-repeat="msg in messages"  class="message clearfix">
						<span class="author">[[msg.user]]</span>
						<br>
						<div class="image">
							<img src="/img/default.png" class="portrait" alt="">
						</div>
						<div class="text" style="border-color: [[stringToColour(msg.user)]] ;">
							<pre><code>[[msg.message]]</code></pre>
						</div>
					</div>
				</div>
			</div>
			<div class="messagetyper">
				<form ng-submit="sendMessage()">
					<input class="form-input" autocomplete="off" placeholder="[[name]]: Type and press Enter" ng-model="message"/>
				</form>
			</div>
			<div class="setuser text-center" >
				<form>
					<h3><strong>Yahtzee Chat</strong></h3>
					<br>
					<i class="fa fa-2x fa-spinner fa-spin"></i>
				</form>
			</div>
		</div>
	</div>
</div>