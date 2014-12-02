<div class="container-fluid">
	{{ Form::open(array('action' => 'UsersController@handleLogin', 'method' => 'post', 'class' => 'form-vertical')); }}
	<div class="form-group">
		{{Form::label('username','Username');}}
		{{Form::text('username', null,array('class' => 'form-control'));}}
	</div>
	<div class="form-group">
		{{Form::label('password','Password');}}
		{{Form::password('password',array('class' => 'form-control'));}}
	</div>
	<div class="form-group">
		{{link_to(URL::action('RemindersController@getRemind'),'Forgot password');}}
	</div>
	{{Form::submit('Login', array('class' => 'btn btn-primary'));}}
	{{Form::close(); }}
</div>
