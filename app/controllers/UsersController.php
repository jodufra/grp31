<?php

class UsersController extends BaseController
{
    /**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
    public function index()
    {
        //
    }
    public function game()
    {
        return View::make('game.index');
    }
    public function login()
    {
        return View::make('layouts.scaffold');
    }

    public function handleLogin()
    {
        $input = Input::only(['username', 'password']);
        $validator = Validator::make($input, User::$login_rules);

        if($validator->fails()){
            return Redirect::route('home')->withErrors($validator)->withInput();
        }
        if(Auth::attempt(['username' => $input['username'], 'password' => $input['password']])){
            return Redirect::route('game');
        } elseif(Auth::attempt(['email' => $input['username'], 'password' => $input['password']])){
            return Redirect::route('game');
        }

        return Redirect::route('home')->withInput();
    }

    public function profile()
    {
        return View::make('users.profile');
    }

    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
        }
        return Redirect::route('home');
    }

    /**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
    public function create()
    {
        return View::make('users.create');
    }

    /**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
    public function store()
    {
        $input = Input::only(['username','email','password', 'password_confirmation']);

        $validator = Validator::make($input, User::$create_rules);

        if($validator->fails()){
            return Redirect::route('user.create')->withErrors($validator)->withInput();
        }

        $unusedUser = User::where('username','=',$input['username'])->count() != 0;
        $unusedEmail = User::where('email','=',$input['email'])->count() != 0;
        if($unusedUser) {
            return Redirect::route('user.create')->withErrors('Username already in use')->withInput();
        }elseif($unusedEmail){
            return Redirect::route('user.create')->withErrors('Email already in use')->withInput();
        }
        $input['hashed_password'] = Hash::make($input['password']);
        $newUser = User::create($input);
        if($newUser){
            Auth::login($newUser);
            return Redirect::route('user.show');
        }

        return Redirect::route('user.create')->withErrors('An error has ocurred, Please try again later.')->withInput();
    }

    /**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function show($id)
    {

        return View::make('users.show');
    }

    /**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($id)
    {
        //
    }

    /**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id)
    {
        //
    }

    /**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        //
    }

}
