@extends('layouts.scaffold_sidebar')

@section('sidebar')
<div class="list-group">
  <a href="/" class="list-group-item">
    <h4 class="list-group-item-heading">Home</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>
  <a href="/game" class="list-group-item active">
    <h4 class="list-group-item-heading">Games</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>
  <a href="/tournament" class="list-group-item">
    <h4 class="list-group-item-heading">Tournaments</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>
  <a href="/replay" class="list-group-item">
    <h4 class="list-group-item-heading">Replays</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>
  <a href="/calendar" class="list-group-item">
    <h4 class="list-group-item-heading">Calendar</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>
  <a href="/ranking" class="list-group-item">
    <h4 class="list-group-item-heading">Ranking</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>
</div>
@endsection
@section('body')
<div ng-controller="DicesController">
	<div class="col-md-1"></div>
	<div class="col-md-7">
		<div>
			<img style="display:none;" src="{{asset('img/dice1.png')}}" />
			<img style="display:none;" src="{{asset('img/dice2.png')}}" />
			<img style="display:none;" src="{{asset('img/dice3.png')}}" />
			<img style="display:none;" src="{{asset('img/dice4.png')}}" />
			<img style="display:none;" src="{{asset('img/dice5.png')}}" />
			<img style="display:none;" src="{{asset('img/dice6.png')}}" />
			<div >
				<img ng-repeat="dice in dices" src="{{asset('img/dice[[dice.val]].png')}}" />
			</div>
			<button ng-click="randomize()">Roll</button>

		</div>
	</div>

	<!-- TABLE -->
	<div class="col-md-3">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed">
				<thead>
					<tr>
						<th>Score Table</th>
						<th>You</th>
						<th>Opponent</th>
					</tr>
				</thead>
				<tbody>
					<tr id="ones">
						<th>Ones</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="twos">
						<th>Twos</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="threes">
						<th>Threes</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="fours">
						<th>Fours</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="fives">
						<th>Fives</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="sixes" class="info" style="border-bottom: solid 2px #333">
						<th>Sixes</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="sum">
						<th>Sum</th>
						<td ng-bind="result['sum']()"></td>
						<td></td>
					</tr>
					<tr id="bonus" class="info" style="border-bottom: solid 2px #333">
						<th>Bonus</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="three-of-a-kind">
						<th>Three of a kind</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="four-of-a-kind">
						<th>Four of a kind</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="full-house">
						<th>Full House</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="small-straight">
						<th>Small straight</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="large-straight">
						<th>Large straight</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="chance">
						<th>Chance</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="yahtzee" class="info" style="border-bottom: solid 2px #333">
						<th>YAHTZEE</th>
						<td></td>
						<td></td>
					</tr>
					<tr id="total-score">
						<th>TOTAL SCORE</th>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
