<?php

class SpectatorsController extends \BaseController {

	/**
	 * Display a listing of spectators
	 *
	 * @return Response
	 */
	public function index()
	{
		$spectators = Spectator::all();

		return View::make('spectators.index', compact('spectators'));
	}

	/**
	 * Show the form for creating a new spectator
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('spectators.create');
	}

	/**
	 * Store a newly created spectator in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Spectator::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Spectator::create($data);

		return Redirect::route('spectators.index');
	}

	/**
	 * Display the specified spectator.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$spectator = Spectator::findOrFail($id);

		return View::make('spectators.show', compact('spectator'));
	}

	/**
	 * Show the form for editing the specified spectator.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$spectator = Spectator::find($id);

		return View::make('spectators.edit', compact('spectator'));
	}

	/**
	 * Update the specified spectator in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$spectator = Spectator::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Spectator::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$spectator->update($data);

		return Redirect::route('spectators.index');
	}

	/**
	 * Remove the specified spectator from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Spectator::destroy($id);

		return Redirect::route('spectators.index');
	}

}
