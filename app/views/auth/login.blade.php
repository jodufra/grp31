@extends('layouts.scaffold')
@section('body')
<div class="col-md-8 col-md-offset-2">
	<div class="page-header"><h1>Login</h1></div>
	@include('partials.session_messages')
	<div class="row row-item">
		@include('auth.login_form')
	</div>
</div>
@stop