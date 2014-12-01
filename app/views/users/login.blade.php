<div class="container-fluid">
	
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
	@endif
	{{ Form::open(array('action' => 'UsersController@handleLogin', 'method' => 'post')); }}
	{{ Form::label('username','Username');}}
	{{ Form::text('username', null, array('class' => 'form-control'));}}
	{{ Form::label('password','Password');}}
	{{ Form::password('password',array('class' => 'form-control'));}}
	{{ Form::submit('Login', array('class' => 'btn btn-primary'));}}
	{{ Form::close(); }}
</div>