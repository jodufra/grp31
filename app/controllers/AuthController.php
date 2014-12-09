<?php

class AuthController extends BaseController {

	public function getLogin()
	{
		return View::make('auth.login');
	}

	public function postLogin()
	{
		$input = Input::only(['username', 'password']);
		$validator = Validator::make($input, User::$login_rules);

		if($validator->fails()) {
			return Redirect::to('login')->withErrors($validator)->withInput(Input::only('username'));
		}

		if(Auth::attempt(['username' => $input['username'], 'password' => $input['password']])) 
		{
			return Redirect::to('/')->with('success','Wellcome '.Auth::user()->username);
		} 
		elseif(Auth::attempt(['email' => $input['username'], 'password' => $input['password']])) 
		{
			return Redirect::to('/')->with('success','Wellcome '.Auth::user()->username);
		}

		return Redirect::to('login')->withErrors('Wrong Username/Email and Password combination.')->withInput(Input::only('username'));
	}

	public function getLogout()
	{
		if(Auth::check()){
			Auth::logout();
		}
		return Redirect::to('/')->with('success','You have logged out.');
	}

}