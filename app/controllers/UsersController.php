<?php

class UsersController extends BaseController
{
	/**
	 * User Repository
	 *
	 * @var user
	 */
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	public function getCurrentUser()
	{
		if (Auth::check()) {
			return Response::json(array('user_id' => Auth::user()->id, 'username' => Auth::user()->username));
		}

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
		$data = Input::all();
		$validator = Validator::make($data, User::$create_rules);
		if ($validator->fails()) {
			return Redirect::route('user.create')->withErrors($validator)->withInput();
		}

		$validator = Validator::make($data, Person::$rules);
		if ($validator->fails()) {
			return Redirect::route('user.create')->withErrors($validator)->withInput();
		}

		try {
			$data['password'] = Hash::make($data['password']);
			$this->user = $this->user->create($data);
			if (!$this->user) {
				throw new Exception();
			}
		} catch (Exception $e) {
			return Redirect::route('user.create')->withErrors("Error Processing Request. Please try again.")->withInput();
		}

		try {
			if (Input::hasFile('photo_file')) {

				$extension = Input::file('photo_file')->getClientOriginalExtension();
				$filename = $this->user->username;
				$filename = str_replace(' ', '_', $filename);
				$filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename);
				if ($filename == '') {
					$filename = 'user' . $this->user->id;
				}
				Input::file('photo_file')->move(public_path() . '/img/uploads/', $filename . '.' . $extension);
				$data['photo'] = ('/img/uploads/' . $filename . '.' . $extension);
			} else {
				$data['photo'] = ('/img/default.png');
			}

			$data['name'] = $data['first_name'] . " " . $data['last_name'];
			$data['credit_card_valid'] = $data['credit_card_valid_month'] . "/" . $data['credit_card_valid_year'];
			$data['birthdate'] = strtotime($data['birth_date']);
			$data['user_id'] = $this->user->id;
			$this->user->person()->create($data);
			if (!$this->user->person()) {
				throw new Exception();
			}
		} catch (Exception $e) {
			$this->user->delete();
			return Redirect::route('user.create')->withErrors("Error Processing Request. Please try again.")->withInput();
		}


		try {
			$this->user->player()->create($data);
			if (!$this->user->player()) {
				throw new Exception();
			}
		} catch (Exception $e) {
			$this->user->person()->delete();
			$this->user->delete();
			return Redirect::route('user.create')->withErrors("Error Processing Request. Please try again.")->withInput();
		}

		Auth::login($this->user);
		return Redirect::route('home');

	}

	/**
	 * Display the specified resource.
	 * GET /users/
	 *
	 * @return Response
	 */
	public function show($username)
	{
		$result = DB::table('users')->where('username', $username)->first();
		if (!$result) {
			App::abort(404);
		} else {

			$person = Person::where('user_id', '=', $result->id)->first();
			return View::make('users.show')->with(array('user'=> $result,'person'=>$person));
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/edit
	 *
	 * @return Response
	 */
	public function edit()
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/
	 * @return Response
	 */
	public function update()
	{

		if (Input::hasFile('photo_update')) {

			$person = Auth::user()->person()->first();

			$extension = Input::file('photo_update')->getClientOriginalExtension();
			$filename = $this->user->username;
			$filename = str_replace(' ', '_', $filename);
			$filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename);
			if ($filename == '') {
				$filename = 'user' . $this->user->id;
			}
			Input::file('photo_update')->move(public_path() . '/img/uploads/', $filename . '.' . $extension);
			$photo = ('/img/uploads/' . $filename . '.' . $extension);
			$person->photo = $photo;
			$person->push();


		}
		return $this->show(Auth::user()->username);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
