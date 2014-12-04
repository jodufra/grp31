<?php

use Yatzhee\Cryptography\Cryptography;
class AuthController extends BaseController {

	public function getLogin()
	{
		return View::make('users.login');
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

	// public function postLogin() {
	// 	$creds_name = [
	// 	'username' => DecryptedInput::get('username'),
	// 	'password'  => DecryptedInput::get('password'),
	// 	];
	// 	$creds_email = [
	// 	'email' => DecryptedInput::get('username'),
	// 	'password'  => DecryptedInput::get('password'),
	// 	];

	// 	$response = new Yatzhee\Dto\Responses\LoginResponse;

	// 	if(Auth::attempt($creds_name, false) || Auth::attempt($creds_email, false)){
	// 		$response->loginResult = Yatzhee\Dto\Responses\LoginResponse::LOGIN_SUCCESS;
	// 		$response->expire = Auth::user()->tariffExpire;
	// 		return json_encode($response);
	// 	}
	// 	$response->loginResult = Yatzhee\Dto\Responses\LoginResponse::LOGIN_FAIL;
	// 	return json_encode($response);
	// }



	public function logout()
	{
		if(Auth::check()){
			Auth::logout();
		}
		return Redirect::to('/')->with('success','You have logged out.');
	}

}