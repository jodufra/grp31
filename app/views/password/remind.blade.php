@extends('layouts.scaffold')
@section('body')
<div class="col-md-8 col-md-offset-2">
	<div class="page-header"><h1>Recover Password</h1></div>
	@include('partials.session_messages')
	<div class="row row-item">
		{{ Form::open(array('action' => 'RemindersController@postRemind', 'method' => 'post', 'class' => 'form-horizontal'))}}
		<div class="form-group">
			{{Form::label('email','Email:', array('class'=>'col-md-2 control-label text-right'))}}
			<div class="col-md-8">
				{{Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'youremail@example.com'))}}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-2">
				<table>
					<ul>
						<td>{{link_to('/','Cancel', array('class' => 'btn btn-default'))}}</td>
						<td>{{Form::submit('Send Reminder', array('class' => 'btn btn-primary'))}}</td>
					</ul>
				</table>
			</div>
		</div>
		{{ Form::close(); }}
	</div>
</div>
@stop
