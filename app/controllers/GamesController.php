<?php

use ElephantIO\Client,
	ElephantIO\Engine\SocketIO\Version1X;

class GamesController extends \BaseController {

	private $R_NODE_NAME = 'laravelServer';
	private $LARAVEL_COOKIE = 'laravelServerrrrrr';

	public function notifyNode($request_type, $gameid, $r_msg){

		//print_r(mcrypt_list_algorithms());
		$client = new Client(new Version1X('http://localhost:5555'));
		$client->initialize();
		$client->emit($this->R_NODE_NAME, [
			'cookie'=> Crypt::encrypt($this->LARAVEL_COOKIE),
			'request' => $request_type,
			'msg' => $r_msg,
			'gameid' => $gameid]);
		$client->close();
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
	    $dices = [];
	    for ($i = 0; $i < 5; $i++) {
		    $dices[$i] = array('val'=>rand(1,6),'saved'=>false);
		}
        return Response::json($dices);
    }

	/**
	 * Display a listing of games
	 *
	 * @return Response
	 */
	public function index()
	{
		//$games = Game::all();

		//return View::make('games.index', compact('games'));

		return View::make('games.index');
	}

	/**
	 * Show the form for creating a new game
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('games.create');
	}

	/**
	 * Store a newly created game in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Game::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Game::create($data);

		return Redirect::route('games.index');
	}

	/**
	 * Display the specified game.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//$game = Game::findOrFail($id);

		//return View::make('games.show', compact('game'));
		return View::make('games.show', array("game_id"=>$id));
	}

	/**
	 * Show the form for editing the specified game.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$game = Game::find($id);

		return View::make('games.edit', compact('game'));
	}

	/**
	 * Update the specified game in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$game = Game::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Game::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$game->update($data);

		return Redirect::route('games.index');
	}

	/**
	 * Remove the specified game from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Game::destroy($id);

		return Redirect::route('games.index');
	}

}
