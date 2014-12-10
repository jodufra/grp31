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
						<th>
							<button class="btn-navigation" ng-click="previousCurrentScore()"><span class="glyphicon glyphicon-chevron-left"></span></button>
							<span ng-bind="currentScorePlayer.name"></span>
							<button class="btn-navigation" ng-click="nextCurrentScore()"><span class="glyphicon glyphicon-chevron-right"></span></button>
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

@endsection
