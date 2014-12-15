@extends('layouts.scaffold')
@section('body')
<div class="col-md-8 col-md-offset-2">
	<div class="page-header"><h1>Login</h1></div>
	
	<div class="row row-item">
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