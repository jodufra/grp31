@extends('layouts.scaffold')
@section('body')
<div class="col-md-8 col-md-offset-2">
	<div class="page-header"><h1>Recover Password</h1></div>
	@include('partials.session_messages')
	<div class="row row-item">
		{{ Form::open(array('action' => 'RemindersController@postReset', 'method' => 'post', 'class' => 'form-horizontal'))}}
		{{ Form::hidden('token',$token)}}
		<div class="form-group">
			{{Form::label('email','Email', array('class'=>'col-md-3 control-label text-right'))}}
			<div class="col-sm-6">
				{{Form::text('email', null,array('class' => 'form-control','readonly'))}}
			</div>
		</div>
		<div class="form-group">
			{{Form::label('password','Password', array('class'=>'col-md-3 control-label text-right'))}}
			<div class="col-sm-6">
				{{Form::password('password',array('class' => 'form-control'))}}
			</div>
		</div>
		<div class="form-group">
			{{Form::label('password_confirmation','Password Confirmation', array('class'=>'col-md-3 control-label text-right'))}}
			<div class="col-sm-6">
				{{Form::password('password_confirmation',array('class' => 'form-control'))}}
			</div>
		</div>
		{{ Form::submit('Reset Password', array('class' => 'btn btn-primary'))}}
		{{ Form::close(); }}
	</div>
</div>
@stop
