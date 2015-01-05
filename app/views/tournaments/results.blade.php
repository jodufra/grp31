@extends('layouts.scaffold_sidebar')
@section('sidebar')
<?php $sidebar_home = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')
<div class="col-md-12">
<h3>Ranking</h3>
<table class="table">
    <thead>
        <tr>
            <th>Position</th>
            <th>Username</th>
        </tr>
    </thead>

    <tbody>
    <?php $i=1; ?>
    @foreach ($users as $user)
        <tr>
        @if($i==1)
            <td><i class="fa fa-trophy"></i>{{$i;}}</td>
        @else
            <td>{{$i;}}</td>
        @endif
            <td><a href="user/show/{{$user->username}}">{{$user->username}}</a></td>
            <?php $i=$i+1; ?>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection