@extends('layouts.scaffold')
@section('body')
<div class="col-md-6 col-md-offset-3">
	<h1>Login</h1>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
	@endif
	@include('users.login_form')
</div>
@stop