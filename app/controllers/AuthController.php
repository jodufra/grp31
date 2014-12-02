<?php

class AuthController extends \BaseController {

	public function getLogin()
	{
		return View::make('users.login');
	}

	public function postLogin()
	{
		$input = Input::only(['username', 'password']);
		$validator = Validator::make($input, User::$login_rules);

		if($validator->fails()) {
			return Redirect::route('login')->withErrors($validator)->withInput(Input::except('password'));
		}

		if(Auth::attempt(['username' => $input['username'], 'password' => $input['password']])) {
			return Redirect::route('home');
		} elseif(Auth::attempt(['email' => $input['username'], 'password' => $input['password']])) {
			return Redirect::route('home');
		}

		return Redirect::route('login')->withInput(Input::except('password'))->withErrors('Wrong Username/Email and Password combination.');
	}


	public function logout()
	{
		if(Auth::check()){
			Auth::logout();
		}
		return Redirect::route('home')->with('success','You have logged out.');
	}

}