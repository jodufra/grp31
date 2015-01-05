<?php

class RankingController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /ranking
	 *
	 * @return Response
	 */
	public function index()
	{
        $users =User::orderBy('wins','DESC')->take(25)->get();

        return View::make('ranking.show', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ranking/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ranking
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	public function show()
	{
        $users =User::orderBy('wins','DESC')->get(25);

        return View::make('ranking.show', compact('users'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /ranking/{id}/edit
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
	 * PUT /ranking/{id}
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
	 * DELETE /ranking/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}