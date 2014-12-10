<?php

class MovesController extends \BaseController {

	/**
	 * Display a listing of moves
	 *
	 * @return Response
	 */
	public function index()
	{
		$moves = Move::all();

		return View::make('moves.index', compact('moves'));
	}

	/**
	 * Show the form for creating a new move
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('moves.create');
	}

	/**
	 * Store a newly created move in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Move::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Move::create($data);

		return Redirect::route('moves.index');
	}

	/**
	 * Display the specified move.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$move = Move::findOrFail($id);

		return View::make('moves.show', compact('move'));
	}

	/**
	 * Show the form for editing the specified move.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$move = Move::find($id);

		return View::make('moves.edit', compact('move'));
	}

	/**
	 * Update the specified move in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$move = Move::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Move::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$move->update($data);

		return Redirect::route('moves.index');
	}

	/**
	 * Remove the specified move from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Move::destroy($id);

		return Redirect::route('moves.index');
	}

}
