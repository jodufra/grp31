@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_home = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="row-item" ng-controller="TestingNodeController">
      Some Content that appears whatever Auth you have, some more content
      <br>
      <button ng-click="sendRequest()">Random button</button>
      <span ng-bind="response"></span>
    </div>
  </div>
</div>
@endsection