@extends('layouts.scaffold')
@section('body')
<div ng-controller="GamePlayController">
	<div class="col-md-7 col-md-offset-1">
		<div class="row">
			<div class="well">
				<span>Current Player:&nbsp;<span ng-bind="currentPlayer.name"></span></span>
				<img style="display:none;" src="{{asset('img/dice1.png')}}" />
				<img style="display:none;" src="{{asset('img/dice2.png')}}" />
				<img style="display:none;" src="{{asset('img/dice3.png')}}" />
				<img style="display:none;" src="{{asset('img/dice4.png')}}" />
				<img style="display:none;" src="{{asset('img/dice5.png')}}" />
				<img style="display:none;" src="{{asset('img/dice6.png')}}" />
				<div>
					<img ng-repeat="dice in dices" ng-show="dices" src="{{asset('img/dice[[dice.val]].png')}}" />
				</div>
			</div>
		</div>
		<div class="row">
			<button ng-click="roll()">Roll</button>
		</div>
	</div>

	<!-- TABLE -->
	<div class="col-md-3">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed">
				<thead>
					<tr>
						<th>Score Table</th>
						<th style="position:relative">
							<i ng-click="previousCurrentScore()" class="fa fa-chevron-left btn-navigation btn-navigation-score btn-navigation-left"></i>
							<span ng-bind="currentScorePlayer.name"></span>
							<i ng-click="nextCurrentScore()" class="fa fa-chevron-right text-right btn-navigation btn-navigation-score btn-navigation-right"></i>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr id="ones">
						<th>Ones</th>
						<td ng-bind="currentScorePlayer.score['ones']"></td>
					</tr>
					<tr id="twos">
						<th>Twos</th>
						<td ng-bind="currentScorePlayer.score['twos']"></td>
					</tr>
					<tr id="threes">
						<th>Threes</th>
						<td ng-bind="currentScorePlayer.score['threes']"></td>
					</tr>
					<tr id="fours">
						<th>Fours</th>
						<td ng-bind="currentScorePlayer.score['fours']"></td>
					</tr>
					<tr id="fives">
						<th>Fives</th>
						<td ng-bind="currentScorePlayer.score['fives']"></td>
					</tr>
					<tr id="sixes">
						<th>Sixes</th>
						<td ng-bind="currentScorePlayer.score['sixes']"></td>
					</tr>
					<tr id="sum" class="info">
						<th>Sum</th>
						<td ng-bind="currentScorePlayer.score['sum']"></td>
					</tr>
					<tr id="bonus" class="success" style="border-bottom: solid 2px #333">
						<th>Bonus</th>
						<td ng-bind="currentScorePlayer.score['bonus']"></td>
					</tr>
					<tr id="three-of-a-kind">
						<th>Three of a kind</th>
						<td ng-bind="currentScorePlayer.score['threeKind']"></td>
					</tr>
					<tr id="four-of-a-kind">
						<th>Four of a kind</th>
						<td ng-bind="currentScorePlayer.score['fourKind']"></td>
					</tr>
					<tr id="full-house">
						<th>Full House</th>
						<td ng-bind="currentScorePlayer.score['house']"></td>
					</tr>
					<tr id="small-straight">
						<th>Small straight</th>
						<td ng-bind="currentScorePlayer.score['small_s']"></td>
					</tr>
					<tr id="large-straight">
						<th>Large straight</th>
						<td ng-bind="currentScorePlayer.score['large_s']"></td>
					</tr>
					<tr id="chance">
						<th>Chance</th>
						<td ng-bind="currentScorePlayer.score['chance']"></td>
					</tr>
					<tr id="yahtzee" class="info" style="border-bottom: solid 2px #333">
						<th>YAHTZEE</th>
						<td ng-bind="currentScorePlayer.score['yahtzee']"></td>
					</tr>
					<tr id="total-score" class="success" >
						<th>TOTAL SCORE</th>
						<td ng-bind="currentScorePlayer.score['total']"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="chat" ng-app="app">

	<div id="messages_box">
		<ul id="messages"></ul>
	</div>

	<div class="user_box" ng-controller="SubmitController" ng-init="username='blabla';gameid='1'">
		<form  class="user_box_items" ng-submit="sendMessage()">
			<input id="m"  class="user_box_items" autocomplete="off" ng-model="msg"/>
			<button class="user_box_items">Send</button>
		</form>
	</div>

	{{ HTML::script('js/socket.io-1.2.0.js'); }}
	<script>
	var socket = io('https://grp31.dad:5555/');

	function getUsername(msg){
		return msg.split(':')[0];
	}
	socket.on('connect', function(){

		socket.on('chat-msg1', function(msg){
			var list = $('#messages');
			var li = $('<li>');
			if(getUsername(msg)!= 'blabla'){
				li.css({
					'background':'#eee'
				});
			}
			list.append(li.text(msg));
			list.animate({
				scrollTop : li.offset().top
			}, 'slow');
		});
		socket.on('roll1', function(msg){
			alert(msg);
		});

		socket.on('disconnect', function(){
			alert('Chat server have shutting down the connection');
		});

	});

	socket.on('connect_failed', function(){
		alert('Connection to chat server have failed!');
	});


	var chatApp = angular.module('chatApp',[]);
	var SEPARATOR = "$?$?";

	chatApp.controller('SubmitController', ['$scope', function ($scope) {
		$scope.sendMessage = function () {
			var msg = $scope.msg;
			if(msg){
				socket.emit('chat-msg', $scope.gameid + SEPARATOR + $scope.username + ": " + msg);
				$scope.msg = '';
			}
			return false;
		};
	}]);

	</script>



</div>


@endsection
