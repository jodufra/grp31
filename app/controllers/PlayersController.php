<?php

class PlayersController extends BaseController {
	
	function getCurrentuser(){
		return array(
			'id'=>Auth::user()->player()->first()->id, 
			'user_id'=>Auth::user()->id,
			'name'=>Auth::user()->username, 
			'img_src'=>Auth::user()->person()->first()->photo
			);
	}


	/**
	 * Display a listing of playe->first()rs
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$players = Player::all();

		return View::make('players.index', compact('players'));
	}

	/**
	 * Show the form for creating a new player
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('players.create');
	}

	/**
	 * Store a newly created player in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		$validator = Validator::make($data = Input::all(), Player::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Player::create($data);

		return Redirect::route('players.index');
	}

	/**
	 * Display the specified player.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$player = Player::findOrFail($id);

		return View::make('players.show', compact('player'));
	}

	/**
	 * Show the form for editing the specified player.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$player = Player::find($id);

		return View::make('players.edit', compact('player'));
	}

	/**
	 * Update the specified player in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$player = Player::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Player::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$player->update($data);

		return Redirect::route('players.index');
	}

	/**
	 * Remove the specified player from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		Player::destroy($id);

		return Redirect::route('players.index');
	}

}
