<div id="chat" class="col-md-3 col-md-offset-9" ng-controller="ChatController">
	<div class="head clearfix">
		<div class="title pull-left">
			<span class="glyphicon glyphicon-comment" aria-hidden="true"></span><span class="name">&nbsp;Yahtzee Chat</span>
		</div>
		<div class="close pull-right" ng-click="setChatState(false)">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</div>		
	</div>
	<div class="body">
		<span style="color:white;font-size: 11px;">You are connected on channel: [[channel]]</span>
		<br>
		<div class="messageslist">
			<div>
				<div ng-repeat="msg in messages" style="box-shadow: inset 0 0 6px 2px [[stringToColour(msg.user)]]" class="message">
					<span class="author">[[msg.user]]:</span>
					<pre class="text"><code class="text">[[msg.message]]</code></pre>
				</div>
			</div>
		</div>
		<div class="messagetyper">
			<form ng-submit="sendMessage()">
				<input class="form-input" autocomplete="off" placeholder="Type here and press Enter" ng-model="message"/>
			</form>
		</div>
		<div class="setuser text-center" >
			<form ng-submit="joinChat()">
				<h3><strong>Yahtzee Chat</strong></h3>
				<br>
				<input class="text-center" autocomplete="off" placeholder="Type your name" ng-model="name"/>
				<br>
				<br>
				<button class="btn btn-default">Join</button>
			</form>
		</div>
	</div>
	<div class="smallcounter" ng-click="setChatState(true)">
		<span>
			<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>&nbsp;
			<span class="badge">[[unreadedMessages]]</span>
		</span>
	</div>
</div>