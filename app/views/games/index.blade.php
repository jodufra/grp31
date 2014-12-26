@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_game = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')
<div class="row">
  <div class="col-md-12"> 
    <div class="list-group">
      <a href="/game/create" class="list-group-item">
        <h4 class="list-group-item-heading">Create New Game</h4>
        <p class="list-group-item-text">Some kind of description</p>
      </a>
      <a href="/game/1" class="list-group-item">
        <h4 class="list-group-item-heading">Play Game 1</h4>
        <p class="list-group-item-text">Some kind of description</p>
      </a>  
    </div>
    <div class="row-item">
      <p>Some kind of content</p>
    </div>
  </div>
</div>

@endsection
