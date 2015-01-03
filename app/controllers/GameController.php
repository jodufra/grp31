<?php

use ElephantIO\Client,
ElephantIO\Engine\SocketIO\Version1X;

class GameController extends \BaseController {

    /**
     * User Repository
     *
     * @var user
     */
    protected $game;

    public function __construct(Game $game)
    {
    	$this->game = $game;
    }

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

    public function getOngoinggames()
    {
    	$games = [];
    	$q_games = Game::take(10)->skip(0)->get();
    	$g_count = 0;
    	foreach ($q_games as $this->game) {
    		$games[$g_count] = [];
    		$games[$g_count]['id'] = $this->game->id;
    		$games[$g_count]['players'] = [];
    		$q_players = DB::table('games_have_players')->where('game_id', $games[$g_count]['id'])->get();
    		$p_count = 0;
    		foreach ($q_players as $game_have_players) {
    			if($game_have_players->player_id < 10){
    				$games[$g_count]['players'][$p_count]['player_num'] = $game_have_players->player_num;
    				$games[$g_count]['players'][$p_count]['id'] = $game_have_players->player_id;
    				$games[$g_count]['players'][$p_count]['name'] = 'Robot '.$game_have_players->player_id;
    				$p_count++;
    			}else{
    				$user_id = Player::find($game_have_players->player_id)->user_id;
    				$games[$g_count]['players'][$p_count]['player_num'] = $game_have_players->player_num;
    				$games[$g_count]['players'][$p_count]['id'] = $game_have_players->player_id;
    				$games[$g_count]['players'][$p_count]['name'] = User::find($user_id)->username;
    				$p_count++;
    			}
    		}
    		$g_count++;
    	}

    	return $games;
    }

	/**
	 * Display a listing of games
	 *
	 * @return Response
	 */
	public function getIndex()
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
	public function getCreate()
	{
		return View::make('games.create');
	}

	/**
	 * Store a newly created game in storage.
	 *
	 * @return Response
	 */
	public function postStore(){   
		$data = [];
		$data['players_count'] = 0;
		$data['one_player_is_user'] = false;
		$myID = Auth::user()->id;
		$players = Input::get('players');
		$count = 0;
		foreach($players as $player){
			if($player['user_id']){
				if($myID == $player['user_id']){
					$data['player_is_user'] = true;
				}
			}
			$count++;
		}
		unset($player); 
		$data['players_count'] = $count;
		$validator = Validator::make($data, Game::$rules);

		if ($validator->fails()){
			$message = '';
			if ($validator->messages()->has('players_count')){
				$message = $validator->messages()->first('players_count');
			}else{
				$message = $validator->messages()->first('one_player_is_user');
			}
			return Response::json(['message'=>$message], 400);
		}

		try{
			$this->game=$this->game->create([]);
			$count = 0;
			foreach($players as $player){
				$count++;
				GameHavePlayer::create(['game_id'=>$this->game->id,'player_id'=>$player['id'],'player_num'=>$count]);
			}
			unset($player);
		}catch(Exception $e){
			return Response::json(['message'=>$e], 400);
		}

		return Response::json(['game_id'=>$this->game->id]);
	}

	/**
	 * Display the specified game.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
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
	public function getEdit($id)
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
	public function putUpdate($id)
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
	public function deleteDestroy($id)
	{
		Game::destroy($id);

		return Redirect::route('games.index');
	}
}
