@extends('layouts.scaffold')
@section('body')
<div class="col-md-8 col-md-offset-2">
	<div class="row row-item">
		<h1>Login</h1>

		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</ul>
		</div>
		@endif
		@include('auth.login_form')
	</div>
</div>
@stop