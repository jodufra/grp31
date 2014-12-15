<div class="container-fluid" style="background-color: white;">
	{{ Form::open(array('action' => 'AuthController@postLogin', 'method' => 'post', 'class' => 'form-vertical')); }}
	<br>
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
	<hr>
	<div class="form-group">
		{{Form::submit('Login', array('class' => 'btn btn-primary'));}}
	</div>
	{{Form::close(); }}
</div>
