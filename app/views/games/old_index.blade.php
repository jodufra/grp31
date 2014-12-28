@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_game = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')
@include('partials.createGame')
<div class="row" ng-controller="GameIndexController">
  <div class="col-md-10">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
      </ul>
    </div>
    @endif
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align: right"><button id="createGame" type="button" class="btn btn-info" data-toggle="modal" data-target="#createGameModal">Create Game</button></td>
        </tr>
        <tr>
          <th>Description</th>
          <th>Number of players</th>
          <th>Join</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="game in games">
          <td>[[game.name]]</td>
          <td></td>
          <td><button id="createGame" class="btn btn-info" ng-click="btnJoinGameClick(this)">join</button></td>
        </tr>
      </tbody>
    </table>
    {{--<div class="list-group">--}}
    {{--<a href="/game/create" class="list-group-item">--}}
    {{--<h4 class="list-group-item-heading">Create New Game</h4>--}}
    {{--<p class="list-group-item-text">Some kind of description</p>--}}
    {{--</a>--}}
    {{--<a href="/game/1" class="list-group-item">--}}
    {{--<h4 class="list-group-item-heading">Play Game 1</h4>--}}
    {{--<p class="list-group-item-text">Some kind of description</p>--}}
    {{--</a>  --}}
    {{--</div>--}}

  </div>
</div>

@endsection
