@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_home = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')
<div class="col-md-12" ng-controller="TournamentController">
    @if(Auth::user()!=null &&(Auth::user()->role==0 || Auth::user()->role==1) )
     <a class="button" href="/tournaments/start/[[tournamenID]]">
            <div class="jumbotron button">
              <h2 class="text-info"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Start tournament</h2>
            </div>
     </a>
     @endif
    <h3>Players</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Wins</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
             <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->wins}}</td>
             </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection