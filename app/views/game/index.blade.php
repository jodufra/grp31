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
<div class="row row-item">
  <a href="/game/game/0" class="list-group-item">
    <h4 class="list-group-item-heading">Play</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>
</div>
<div class="row row-item">
  <a href="/game/game/0" class="list-group-item">
    <h4 class="list-group-item-heading">Play</h4>
    <p class="list-group-item-text">Some kind of description</p>
  </a>	
</div>

@endsection
