<?php

class GameController extends BaseController
{
    /**
	 * Display a listing of the resource.
	 * GET /game
	 *
	 * @return Response
	 */
    public function getIndex()
    {
        return View::make('game.index');
    }

    /**
     * Display a listing of the resource.
     * GET /game/game/{id}
     *
     * @return Response
     */
    public function getGame($id)
    {
        return View::make('game.game');
    }
    /**
	 * Show the form for creating a new resource.
	 * GET /game/create
	 *
	 * @return Response
	 */
    public function create()
    {
        //
    }

    /**
	 * Store a newly created resource in storage.
	 * POST /game
	 *
	 * @return Response
	 */
    public function store()
    {
        //
    }

    /**
	 * Display the specified resource.
	 * GET /game/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function show($id)
    {
        //
    }

    /**
	 * Show the form for editing the specified resource.
	 * GET /game/{id}/edit
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
	 * PUT /game/{id}
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
	 * DELETE /game/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        //
    }


    public function scoreCalculator()
    {
        $dices=array();
        $dices[0]=Input::get('1',0);
        $dices[1]=Input::get('2',0);
        $dices[2]=Input::get('3',0);
        $dices[3]=Input::get('4',0);
        $dices[4]=Input::get('5',0);
        $calculator = new YahtzeeCombinationCalculator();
        $result=$calculator->getScore($dices);
        return View::make('game.index')->with('result', $result);
    }

    public function getDices()
    {
        $result = array(
            array(
                "dice" => rand(1,6)
                ),
            array(
                "dice" => rand(1,6)
                ),
            array(
                "dice" => rand(1,6)
                ),
            array(
                "dice" => rand(1,6)
                ),
            array(
                "dice" => rand(1,6)
                ),
            );
        $teste = array(array(rand(1,6)),array(rand(1,6)),array(rand(1,6)),array(rand(1,6)),array(rand(1,6)));
        return Response::json($teste);
    }
}
