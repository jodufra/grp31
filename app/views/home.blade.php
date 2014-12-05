@extends('layouts.scaffold')

@section('body')
<div class="col-md-4">
    <div class="sidebar">
        <ul class="nav nav-list">
            <li class="active">
                <a href="/" >
                    Lobby
                </a>
            </li>
            <li class="">
                <a href="#">
                    Tournaments
                </a>
            </li>
            <li class="">
                <a href="#">
                    Replays
                </a>
            </li>
            <li class="">
                <a href="#">
                    Calendário
                </a>
            </li>
            <li>
                <a href="#">
                    Ranking
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="col-md-8" ng-view>
    <div class="">
        <a href="#/game">Go to Lobby</a>
    </div>
</div>
@stop