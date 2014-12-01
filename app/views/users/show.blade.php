@extends('layouts.scaffold')
@section('body')
<div class="container">
    <div>
        @if(Auth::check())
            <p>Welcome to your profile page {{Auth::user()->first_name}} - {{Auth::user()->last_name}}</p>
        @else
            <h1>You are not allowed to be in this page</h1>
        @endif
    </div>
</div>
@stop
