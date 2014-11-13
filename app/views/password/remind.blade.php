@extends('layouts.scaffold')
@section('body')
<div class="col-md-6 col-md-offset-3">
	<h1>Recover Password</h1>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
	@endif
	@if (isset($status))
	<div class="alert alert-success">
		<ul>
			<li class="success">{{$status}}</li>
		</ul>
	</div>
	@endif
	{{ Form::open(array('action' => 'RemindersController@postRemind', 'method' => 'post', 'class' => 'form-vertical'))}}
	<div class="form-group">
		{{Form::label('email','Email:')}}
		{{Form::email('email', '', array('class' => 'form-control'))}}
	</div>
	{{ Form::submit('Send Reminder', array('class' => 'btn btn-primary'))}}
	{{ Form::close(); }}
</div>
@stop
