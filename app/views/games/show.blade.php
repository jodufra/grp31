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
		<div ng-cloak ng-if="started" class="container">
			<div class="row players-wrapper">
				<div class="players clearfix">
					<div class="player" ng-repeat="player in game.players" ng-class"active:player.player_num == game.turn">
						<span ng-if="player.online" class="glyphicon glyphicon-off text-success" data-toggle="tooltip" data-placement="bottom" title="Online"></span>
						<span ng-if="isDisconnected(player)" class="glyphicon glyphicon-off text-warning" data-toggle="tooltip" data-placement="bottom" title="Disconnected"></span>
						<span ng-if="!player.online" class="glyphicon glyphicon-off text-danger" data-toggle="tooltip" data-placement="bottom" title="Offline"></span>

						<img ng-if="player.player_num == game.turn" src="[[player.user.img_src]]" class="portrait active" alt="">
						<img ng-if="!(player.player_num == game.turn)" src="[[player.user.img_src]]" class="portrait" alt="">
						<span ng-bind="player.user.name"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-9">
					<div class="row">
						<div class="player single-player" ng-if="getOpponent()" >
							<img src="[[getOpponent().user.img_src]]" class="portrait" alt="">
							<span ng-bind="getOpponent().user.name"></span>
						</div>
					</div>
					<div class="row">
						<div class="table-wrapper">
							<img class="table" src="/img/table.png" />
							<div class="dices-wrapper">
								<span class="dices">
									<img ng-repeat="dice in getPlayerOpponentSavedDices()" src="/img/dice[[dice.value]].png" class="dice" alt="">
								</span>
								<br>
								<span class="dices">
									<img ng-repeat="dice in getPlayerDices()" src="/img/dice[[dice.value]].png" ng-click="saveDice(dice)" class="dice" alt="">
								</span>
								<br>
								<span class="dices">
									<img ng-repeat="dice in getPlayerSavedDices()" src="/img/dice[[dice.value]].png" ng-click="unsaveDice(dice)" class="dice" alt="">
								</span>
							</div>
							<div class="controls-wrapper">
								<span class="btn-group">
									<button class="btn btn-default" ng-disabled="!canRoll()" ng-click="roll()">Roll</button>
									<input type="number" id="rollCheatValue" class="btn btn-default" style="width: 50px" \>
									<button class="btn btn-default" ng-disabled="!canRoll()" ng-click="rollCheat()">RollCheat</button>
									<button class="btn btn-default" ng-disabled="!canEndTurn()" ng-click="endTurn()">End Turn</button>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="player single-player" ng-if="getUser()">
							<span ng-bind="getUser().name"></span>
							<img src="[[getUser().img_src]]" class="portrait" alt="">
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
									<span ng-if="!(getCurrentScorePlayer().player_num == game.turn)" ng-bind="getCurrentScorePlayer().user.name" ></span>
									<span ng-if="getCurrentScorePlayer().player_num == game.turn" class="text-warning" ng-bind="getCurrentScorePlayer().user.name" ></span>
									<i ng-click="nextCurrentScore()" class="fa fa-chevron-right text-right btn-navigation btn-navigation-score btn-navigation-right"></i>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr id="ones">
								<th>Ones</th>
								<td ng-bind="getCurrentScorePlayer().score['ones']"></td>
							</tr>
							<tr id="twos">
								<th>Twos</th>
								<td ng-bind="getCurrentScorePlayer().score['twos']"></td>
							</tr>
							<tr id="threes">
								<th>Threes</th>
								<td ng-bind="getCurrentScorePlayer().score['threes']"></td>
							</tr>
							<tr id="fours">
								<th>Fours</th>
								<td ng-bind="getCurrentScorePlayer().score['fours']"></td>
							</tr>
							<tr id="fives">
								<th>Fives</th>
								<td ng-bind="getCurrentScorePlayer().score['fives']"></td>
							</tr>
							<tr id="sixes">
								<th>Sixes</th>
								<td ng-bind="getCurrentScorePlayer().score['sixes']"></td>
							</tr>
							<tr id="sum" class="info">
								<th>Sum</th>
								<td ng-bind="getCurrentScorePlayer().score['sum']"></td>
							</tr>
							<tr id="bonus" class="success" style="border-bottom: solid 2px #333">
								<th>Bonus</th>
								<td ng-bind="getCurrentScorePlayer().score['bonus']"></td>
							</tr>
							<tr id="three-of-a-kind">
								<th>Three of a kind</th>
								<td ng-bind="getCurrentScorePlayer().score['threeKind']"></td>
							</tr>
							<tr id="four-of-a-kind">
								<th>Four of a kind</th>
								<td ng-bind="getCurrentScorePlayer().score['fourKind']"></td>
							</tr>
							<tr id="full-house">
								<th>Full House</th>
								<td ng-bind="getCurrentScorePlayer().score['house']"></td>
							</tr>
							<tr id="small-straight">
								<th>Small straight</th>
								<td ng-bind="getCurrentScorePlayer().score['small_s']"></td>
							</tr>
							<tr id="large-straight">
								<th>Large straight</th>
								<td ng-bind="getCurrentScorePlayer().score['large_s']"></td>
							</tr>
							<tr id="chance">
								<th>Chance</th>
								<td ng-bind="getCurrentScorePlayer().score['chance']"></td>
							</tr>
							<tr id="yahtzee" class="info" style="border-bottom: solid 2px #333">
								<th>YAHTZEE</th>
								<td ng-bind="getCurrentScorePlayer().score['yahtzee']"></td>
							</tr>
							<tr id="total-score" class="success" >
								<th>TOTAL SCORE</th>
								<td ng-bind="getCurrentScorePlayer().score['total']"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div ng-if="endingturn" class="game-choice-container">
				<div class="game-choice-wrapper">
					<div class="container-fluid">
						<div class='row'>
							<p class="pull-left"><strong>Choose a reward</strong></p>
							<span ng-if="canRoll()" class="close pull-right" ng-click="closeEndingTurn()">Close</span>
						</div>
						<hr>
						<div class='row'>
							<table class="table">
								<tr ng-repeat="score in endTurnScores()">
									<td ng-bind="score.name"></td>
									<td><button class="btn btn-default form-control" ng-bind="score.value" ng-click="endTurnWithScore([[score.name]])"></button></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('partials.chat')
	<script> appConstants.constant('GAME', {{json_encode($game)}} ); </script>
	@include('partials.includes_aload')
</body>
</html>