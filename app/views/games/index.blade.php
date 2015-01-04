@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_game = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')
<div class="row" ng-controller="GameIndexController">
  <div class="col-md-12">
    @include('partials.session_messages')
  </div>
  @if(Auth::check())
  <div class="clearfix" ng-if="isUser">
    <div ng-if="!isPlaying && !isSearching" class="col-md-6">
      <a class="button" href="/game/create">
        <div class="jumbotron button">
          <h2 class="text-info"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Create Game</h2>
        </div>
      </a>
    </div>
    <div ng-if="!isPlaying && !isSearching" class="col-md-6" ng-click="searchGame()">
      <div class="jumbotron button">
        <h2 class="text-success"><span class="glyphicon glyphicon-play"></span>&nbsp;&nbsp;&nbsp;Join Game</h2>
      </div>
    </div>
    <div ng-if="isPlaying" class="col-md-12">
      <a class="button" href="/game/1">
        <div class="jumbotron button">
          <h2 class=""><span class="glyphicon glyphicon-share-alt"></span>&nbsp;&nbsp;&nbsp;Reenter Game</h2>
        </div>
      </a>
    </div>
    <div ng-if="isSearching" class="col-md-12" ng-click="stopSearching()">
        <div class="jumbotron button searching">
          <h2 class="text-info">
            <i class="fa fa-spinner fa-spin"></i>
            <span>&nbsp;&nbsp;&nbsp;</span><span>Searching for a Game</span><span>&nbsp;&nbsp;&nbsp;</span>
            <small>Time In Queue: <timer interval="1000">[[minutes]] minute[[minutesS]],&nbsp; [[seconds]] second[[secondsS]]</timer></small>
          </h2>
          <h2 class="text-warning searching"><i class="fa fa-question-circle"></i>&nbsp;&nbsp;&nbsp;Stop Searching</h2>
        </div>
    </div>
  </div>
  @endif
  <div class="col-md-12"> 
    
    <div class="row-item games">
      <h3>Ongoing Games</h3>
      <hr>
      <p ng-if="!ongoingGames.length" class="text-muted"> There are no games currently being played.</p>
      <div class="games-wrapper clearfix">
        <div class="game-wrapper" ng-repeat='game in ongoingGames'>
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              {{Form::open(array('url' => '/spectators/', 'method' => 'post'))}}
              @if(Auth::check())
              {{Form::hidden('player_id',Auth::user()->person()->first()->id)}}
              @endif
              {{Form::hidden('game_id','[[game.id]]')}}
              <button type="submit" class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </button>
              {{Form::close()}}
              <div class="names impar">
                <div ng-repeat="player in game.players" ng-if="player.player_num % 2">
                  <a ng-if="!(player.id < 10)" ng-bind="player.name" href="/user/show/[[player.name]]"></a>
                  <span ng-if="player.id < 10" ng-bind="player.name"></span>
                </div>
              </div>
              <div class="names par">
                <div ng-repeat="player in game.players" ng-if="!(player.player_num % 2)">
                  <a ng-if="!(player.id < 10)" ng-bind="player.name" href="/user/show/[[player.name]]"></a>
                  <span ng-if="player.id < 10" ng-bind="player.name"></span>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

@endsection
