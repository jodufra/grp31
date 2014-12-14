@extends('layouts.scaffold')

@section('body')

<div ng-controller="CreateGameController">
	<div class="page-header"><h1>Create Game</h1></div>
	<div ng-show="userIsLeader()">
		<div class="clearfix" >
			<button ng-disabled="[[roomIsFull()]]" ng-click="addRobot()" type="button" class="btn btn-success btn-sm pull-left">
				<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Add Robot
			</button>
			<button ng-disabled="[[haveBots()]]" ng-click="removeAllRobots()" type="button" class="btn btn-warning btn-sm pull-left">
				<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;Remove All Robots
			</button>
			<button class="btn btn-primary btn-sm pull-right">
				<span class="glyphicon glyphicon-play" aria-hidden="true"></span>&nbsp;Start Game
			</button>
			<button class="btn btn-danger btn-sm pull-right">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;Quit
			</button>
		</div>
		<hr>
	</div>
	<div class="col-md-8">
		<div class="row">
			<div ng-show="havePlayers()" class="list-group">
				<div class="list-group-item col-md-6 clearfix" ng-repeat="player in getPlayers()">
					<div class="pull-left text-left">
						<img class="portrait portrait-s" alt="" src="[[player.img_src]]">
						<span>[[player.username]]</span>
						<span ng-show="player.is_user" class="glyphicon glyphicon-user text-info" aria-hidden="true" data-toggle="tooltip" title="Yep!! Thats you!"></span>
						<span ng-show="player.is_leader" class="glyphicon glyphicon-flag text-success" aria-hidden="true" data-toggle="tooltip" title="The Room Leader"></span>
					</div>
				</div>
			</div>
		</div>					
	</div>
	<div class="col-md-3 col-md-offset-1" style="padding-right: 0">
		<div class="row row-item">
			<table class="table">
				<thead><th>Invited</th></thead>
				<tbody>
					<td>
						<div class="media">
							<a class="media-left media-middle" href="">
								<i class="fa fa-spinner fa-spin"></i>
							</a>
							<div class="media-body">
								<span class="media-heading">Media heading</span>
							</div>
						</div>
						<div class="media">
							<a class="media-left media-middle" href="">
								<i class="fa fa-remove text-danger"></i>
							</a>
							<div class="media-body">
								<span class="media-heading">Media heading</span>
							</div>
						</div>
						<div class="media">
							<a class="media-left media-middle" href="">
								<i class="fa fa-check text-success"></i>
							</a>
							<div class="media-body">
								<span class="media-heading">Media heading</span>
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
						<div class="media">
							<a class="media-left media-middle" href="">
								<i class="fa fa-plus"></i>
							</a>
							<div class="media-body">
								<span class="media-heading">Media heading</span>
							</div>
						</div>
						<div class="media">
							<a class="media-left media-middle" href="">
								<i class="fa fa-plus"></i>
							</a>
							<div class="media-body">
								<span class="media-heading">Media heading</span>
							</div>
						</div>
					</td>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
