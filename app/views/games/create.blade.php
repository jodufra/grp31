@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_game = true ?>
@include('partials.common_sidebar')
@endsection

@section('body')
<div ng-controller="GameCreateController">
	<div class="page-header"><h1>Create Game</h1></div>
	@include('partials.session_messages')
	<div ng-show="isLeader(user.name)">
		<div class="clearfix" >
			<div class="pull-left clearfix">
				<button ng-if="players.length < 10" ng-click="addRobot()" type="button" class="btn btn-success btn-sm pull-left">
					<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Add Robot
				</button>
				<span class="pull-left">&nbsp;</span>
				<button ng-if="botsCount() > 0" ng-click="removeAllRobots()" type="button" class="btn btn-warning btn-sm pull-left">
					<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;Remove All Robots
				</button>
			</div>

			<div class="pull-right clearfix">
				<button class="btn btn-danger btn-sm pull-left">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;Quit
				</button>
				<span class="pull-left">&nbsp;</span>
				<div class="pull-left">
				{{Form::open(array( 'method' => 'post'))}}
				<input ng-repeat="player in getPlayers()" type="hidden" name="[[$index]]" value="[[player.id]]">
				<button ng-if="players.length >= 2" type="submit" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-play" aria-hidden="true"></span>&nbsp;Start Game
				</button>
				{{Form::close()}}
				</div>
			</div>
		</div>
		<hr>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div ng-if="havePlayers()" class="list-group">
				<div class="list-group-item col-md-6 clearfix" ng-repeat="player in getPlayers()">
					<div class="pull-left text-left">
						<img class="portrait portrait-s" alt="" src="[[player.img_src]]">
						<span>[[player.name]]</span>
						<span ng-if="isUser(player.name)" class="glyphicon glyphicon-user text-info" aria-hidden="true" data-toggle="tooltip" title="Yep!! Thats you!"></span>
						<span ng-if="isLeader(player.name)" class="glyphicon glyphicon-flag text-success" aria-hidden="true" data-toggle="tooltip" title="The Room Leader"></span>
						<span ng-if="!isLeader(player.name) && !isUser(player.name) && isLeader(user.name)" ng-click="removePlayerOrBot(player.id)" class="glyphicon glyphicon-remove" aria-hidden="true" style="position: absolute;top:5px;right:5px;cursor:pointer;color:gray;"></span>
					</div>
				</div>
				<div class="list-group-item col-md-6 clearfix empty searching" ng-repeat="n in [] | range: (10 - getPlayers().length)">
					<div class="content">

					</div>
				</div>
			</div>
		</div>					
	</div>
	<div class="col-md-3" style="padding-right: 0">
		<div class="row row-item">
			<table class="table">
				<thead><th>Invited</th></thead>
				<tbody>
					<td>
						<div class="text-muted" ng-if="!invitedPlayers.length">No Invited Players</div>
						<div class="media" ng-repeat="player in invitedPlayers">
							<div class="media-left media-middle">
								<i ng-if="player.state == 'waiting'" class="fa fa-spinner text-info fa-spin"></i>
								<i ng-if="player.state == 'canceled'" class="fa fa-remove text-danger"></i>
								<i ng-if="player.state == 'success'" class="fa fa-check text-success"></i>
							</div>
							<div class="media-body">
								<span class="media-heading" ng-bind="player.name"></span>
							</div>
						</div>
					</td>
				</tbody>
			</table>
		</div>
		<div class="row row-item">
			<table class="table">
				<thead><th>Friends List</th></thead>
				<tbody>
					<td>
						<div class="text-muted" ng-if="!onlineFriends().length">No Online Friends</div>
						<div class="media" ng-repeat="friend in onlineFriends()">
							<a ng-click="inviteFriend(friend)" class="media-left media-middle" href="">
								<i class="fa fa-plus"></i>
							</a>
							<div class="media-body">
								<span class="media-heading" ng-bind="friend.name"></span>
							</div>
						</div>
					</td>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
