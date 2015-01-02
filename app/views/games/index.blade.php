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
    <div ng-if="!isPlaying && !isSearching" class="col-md-6">
      <div class="jumbotron button" ng-click="searchGame()">
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
    <div ng-if="isSearching" class="col-md-12">
        <div class="jumbotron button searching" ng-click="stopSearching()">
          <h2 class="text-info">
            <i class="fa fa-spinner fa-spin"></i>
            <span>&nbsp;&nbsp;&nbsp;</span>
            <span>Searching for a Game</span>
            <span>&nbsp;&nbsp;&nbsp;</span>
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
      <div class="games-wrapper clearfix">
        <div class="game-wrapper">
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              <div class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </div>
              <div class="names impar">
                <span>nasdame 1</span>
                <span>name 1</span>
                <span>namasdasasde 1</span>
                <span>nasme 1</span>
                <span>nadasdme 1</span>
              </div>
              <div class="names par">
                <span>naasdaasdsme 1</span>
                <span>nawqeme 1</span>
                <span>namwwqee 1</span>
                <span>namdsade 1</span>
                <span>naaame 1</span>
              </div>
            </div>
          </div>
        </div>

        <div class="game-wrapper">
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              <div class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </div>
              <div class="names impar">
                <span>nasdame 1</span>
                <span>name 1</span>
                <span>namasdasasde 1</span>
                <span>nasme 1</span>
                <span>nadasdme 1</span>
              </div>
              <div class="names par">
                <span>naasdaasdsme 1</span>
                <span>nawqeme 1</span>
                <span>namwwqee 1</span>
                <span>namdsade 1</span>
                <span>naaame 1</span>
              </div>
            </div>
          </div>
        </div>
        <div class="game-wrapper">
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              <div class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </div>
              <div class="names impar">
                <span>nasdame 1</span>
                <span>name 1</span>
                <span>namasdasasde 1</span>
                <span>nasme 1</span>
                <span>nadasdme 1</span>
              </div>
              <div class="names par">
                <span>naasdaasdsme 1</span>
                <span>nawqeme 1</span>
                <span>namwwqee 1</span>
                <span>namdsade 1</span>
                <span>naaame 1</span>
              </div>
            </div>
          </div>
        </div>
        <div class="game-wrapper">
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              <div class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </div>
              <div class="names impar">
                <span>nasdame 1</span>
                <span>name 1</span>
                <span>namasdasasde 1</span>
                <span>nasme 1</span>
                <span>nadasdme 1</span>
              </div>
              <div class="names par">
                <span>naasdaasdsme 1</span>
                <span>nawqeme 1</span>
                <span>namwwqee 1</span>
                <span>namdsade 1</span>
                <span>naaame 1</span>
              </div>
            </div>
          </div>
        </div>
        <div class="game-wrapper">
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              <div class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </div>
              <div class="names impar">
                <span>nasdame 1</span>
                <span>name 1</span>
                <span>namasdasasde 1</span>
                <span>nasme 1</span>
                <span>nadasdme 1</span>
              </div>
              <div class="names par">
                <span>naasdaasdsme 1</span>
                <span>nawqeme 1</span>
                <span>namwwqee 1</span>
                <span>namdsade 1</span>
                <span>naaame 1</span>
              </div>
            </div>
          </div>
        </div>
        <div class="game-wrapper">
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              <div class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </div>
              <div class="names impar">
                <span>nasdame 1</span>
                <span>name 1</span>
                <span>namasdasasde 1</span>
                <span>nasme 1</span>
                <span>nadasdme 1</span>
              </div>
              <div class="names par">
                <span>naasdaasdsme 1</span>
                <span>nawqeme 1</span>
                <span>namwwqee 1</span>
                <span>namdsade 1</span>
                <span>naaame 1</span>
              </div>
            </div>
          </div>
        </div>
        <div class="game-wrapper">
          <div class="game">
            <div class="wrapper clearfix"> 
              <div class="logo">
                <span class="helper"></span>
                <img src="/img/yahtzee_logo.png" alt="">
              </div>
              <div class="spectate" data-toggle="tooltip" data-placement="top" title="Spectate">
                <span class="glyphicon glyphicon-search"></span>
              </div>
              <div class="names impar">
                <span>nasdame 1</span>
                <span>name 1</span>
                <span>namasdasasde 1</span>
                <span>nasme 1</span>
                <span>nadasdme 1</span>
              </div>
              <div class="names par">
                <span>naasdaasdsme 1</span>
                <span>nawqeme 1</span>
                <span>namwwqee 1</span>
                <span>namdsade 1</span>
                <span>naaame 1</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
