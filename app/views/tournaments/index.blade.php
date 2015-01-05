@extends('layouts.scaffold_sidebar')

@section('sidebar')
<?php $sidebar_home = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')
<div class="col-md-12" ng-controller="TournamentController">
    @if(Auth::user()!=null &&(Auth::user()->role==0 || Auth::user()->role==1))
     <a class="button" href="/tournaments/create">
            <div class="jumbotron button">
              <h2 class="text-info"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Create Tournament</h2>
            </div>
     </a>
     @endif
    <h3>Tournaments</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Begins</th>
                <th>Ends</th>
                <th>Description</th>
                <th>Prize</th>
                <th>Actions</th>
            </tr>
        </thead>
    <?php date_default_timezone_set('Europe/Lisbon'); ?>
        <tbody>
            @foreach ($tournaments as $t)
             <tr>
                <td>{{$t->name}}</td>
                <td>{{$t->begin}}</td>
                <td>{{$t->ends}}</td>
                <td>{{$t->description}}</td>
                <td>{{$t->prize}}</td>
                <td>
                    @if(Auth::user()!=null)
                        @if((new DateTime($t->begin))>=(new DateTime()))
                            <a href="tournaments/subscribe/{{$t->id}}" class="btn btn-info" >Join</a>
                        @endif
                        @if((new DateTime($t->ends))>=(new DateTime()))
                            <a role="btn" href="tournaments/show/{{$t->id}}" class="btn btn-info" style="margin-left: 10px;">See subscribers</a>
                        @endif
                        @if((new DateTime($t->ends))<(new DateTime()))
                            <a role="btn" href="tournaments/showRanking/{{$t->id}}" class="btn btn-info" style="margin-left: 10px;">See results</a>
                        @endif
                    @endif
                </td>
             </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection