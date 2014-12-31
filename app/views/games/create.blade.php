@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_game = true ?>
@include('partials.common_sidebar')
@endsection

@section('body')
<div ng-controller="GameCreateController">
	<div class="page-header"><h1>Create Game</h1></div>
	@include('partials.session_messages')
	<div ng-if="started && isLeader(user.name)">
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
				<button class="btn btn-danger btn-sm pull-left" ng-click="terminateRoom()">
					<span class="glyphicon glyphicon-remove"aria-hidden="true"></span>&nbsp;Quit
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
	<div ng-if="started && !isLeader(user.name)">
		<div class="clearfix" >
			<div class="pull-left clearfix">
				<span class="pull-left">&nbsp;</span>
				<button ng-click="leaveRoom()" type="button" class="btn btn-warning btn-sm pull-left">
					<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;Leave
				</button>
			</div>
		</div>
		<hr>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div ng-if="havePlayers()" class="list-group">
				<div class="list-group-item col-md-6 clearfix" ng-repeat="player in getPlayers()">
					<div class="pull-left text-left">
						<img class="portrait portrait-s" alt="" ng-src="[[player.img_src]]">
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
				<thead><th>Invited Players</th></thead>
				<tbody>
					<td>
						<div class="text-muted" ng-if="!getInvitedPlayers().length">No Invited Players</div>
						<div class="media" ng-repeat="player in getInvitedPlayers()">
							<div class="media-left media-middle">
								<i ng-if="player.state == 'waiting'" class="fa fa-spinner text-info fa-spin" data-toggle="tooltip" data-placement="top" title="Waiting for Player"></i>
								<i ng-if="player.state == 'declined'" class="fa fa-remove text-danger" data-toggle="tooltip" data-placement="top" title="Player is Busy"></i>
								<i ng-if="player.state == 'accepted'" class="fa fa-check text-success" data-toggle="tooltip" data-placement="top" title="Player has Accept"></i>
								<i ng-if="player.state == 'full'" class="fa fa-exclamation-circle text-warning" data-toggle="tooltip" data-placement="top" title="Room is Full"></i>
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
				<thead><th>Invite your Friends</th></thead>
				<tbody>
					<td>
						<div class="text-muted" ng-if="!onlineFriends().length">No Online Friends</div>
						<div class="media" ng-repeat="friend in onlineFriends()">
							<a ng-click="inviteFriend(friend.name)" class="media-left media-middle" href="">
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
