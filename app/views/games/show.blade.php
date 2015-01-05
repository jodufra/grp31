<!doctype html>
<html lang="en" ng-app="app">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	@include('partials.includes_bload')
	<title>Yahtzee</title>
</head>
<body>
	<div class="hidden" ng-controller="UserController"></div>
	<img class="hidden" src="{{asset('img/dice1.png')}}" />
	<img class="hidden" src="{{asset('img/dice2.png')}}" />
	<img class="hidden" src="{{asset('img/dice3.png')}}" />
	<img class="hidden" src="{{asset('img/dice4.png')}}" />
	<img class="hidden" src="{{asset('img/dice5.png')}}" />
	<img class="hidden" src="{{asset('img/dice6.png')}}" />
	@include('partials.header')
	<div id="game-show-container" ng-controller="GameShowController" class="game-show-container game clearfix">
		<div ng-if="started" class="container">
			<div class="row players-wrapper">
				<div class="players clearfix">
					<div class="player" >
						<img src="/img/default.png" class="portrait" alt="">
						<span class="glyphicon glyphicon-record text-success" data-toggle="tooltip" data-placement="bottom" title="Online"></span>&nbsp;<span>user</span>
					</div>
					<div class="player" >
						<img src="/img/default.png" class="portrait active" alt="">
						<span class="glyphicon glyphicon-record text-warning" data-toggle="tooltip" data-placement="bottom" title="Disconected"></span>&nbsp;<span>opponent</span>
					</div>
					<div class="player" ng-repeat="n in [] | range:8">
						<img src="/img/default.png" class="portrait" alt="">
						<span class="glyphicon glyphicon-record text-danger" data-toggle="tooltip" data-placement="bottom" title="Offline"></span>&nbsp;<span>username</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-9">
					<div class="row">
						<div class="player single-player">
							<img src="/img/default.png" class="portrait active" alt="">
							<span>opponent</span>
						</div>
					</div>
					<div class="row">
						<div class="table-wrapper">
							<img class="table" src="/img/table.png" />
							<div class="dices-wrapper">
								<span class="dices">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
								</span>
								<br>
								<span class="dices">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
								</span>
								<br>
								<span class="dices">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
									<img src="/img/dice1.png" class="dice" alt="">
								</span>
							</div>
							<div class="controls-wrapper">
								<span class="btn-group">
									<button class="btn btn-default" disabled>Roll</button>
									<button class="btn btn-default">End Turn</button>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="player single-player">
							<span>user</span>
							<img src="/img/default.png" class="portrait" alt="">
						</div>
					</div>
				</div>
				<div class="col-xs-3">
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>Score Table</th>
								<th style="position:relative">
									<i ng-click="previousCurrentScore()" class="fa fa-chevron-left btn-navigation btn-navigation-score btn-navigation-left"></i>
									<span >opponent</span>
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
	</div>
	@include('partials.chat')
	<script> appConstants.constant('GAME', {{json_encode($game)}} ); </script>
	@include('partials.includes_aload')
</body>
</html>







