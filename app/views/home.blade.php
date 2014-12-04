@extends('layouts.scaffold')
@section('sidebar')
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
@stop
@section('body')
<div class="text-center">
    <a href="#/game">Go to Lobby</a>
</div>
@stop