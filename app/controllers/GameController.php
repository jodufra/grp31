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

    public function getScorecalculator()
    {
    	$dices=array();
    	$dices[0]=Input::get('1',0);
    	$dices[1]=Input::get('2',0);
    	$dices[2]=Input::get('3',0);
    	$dices[3]=Input::get('4',0);
    	$dices[4]=Input::get('5',0);
    	$result = $this->calculator($dices);
    	return $result;
    }

    public function calculator($dices)
    {
    	$calculator = new YahtzeeCombinationCalculator();
    	return $result=$calculator->getScore($dices);
    }

    public function postDices()
    {
    	$player = Input::get('player');
    	$value = Input::get('value');
    	if(!$player){
    		return null;
    	}
    	$dices = $player['dices'];
    	for ($i = 0; $i < 5; $i++) {
    		if(isset($dices[$i]) && $dices[$i]['saved']){
    			continue;
    		}
    		if(isset($value) && $value > 0){
    			$dices[$i] = ['value'=>$value,'saved'=>false];
    		}else{
    			$dices[$i] = ['value'=>rand(1,6),'saved'=>false];
    		}
    	}
    	$calc = [];
    	$calc[0]=$dices[0]['value'];
    	$calc[1]=$dices[1]['value'];
    	$calc[2]=$dices[2]['value'];
    	$calc[3]=$dices[3]['value'];
    	$calc[4]=$dices[4]['value'];

    	$player['dices'] = $dices; 
    	$player['score'] = $this->calculator($calc);
    	return array('player'=>$player);
    }

    public function postEndturn()
    {
    	$player = Input::get('player');

    	$choice = Input::get('choice');
    	
    	return array('player'=>$player);

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
		$this->game = Game::findOrFail($id);
		return View::make('games.show')->with(array("game"=>['id'=>$this->game->id]));
	}

	/**
	 * Display the specified game.
	 *
	 * @param  int  $id
	 * @return Json
	 */
	public function getGame($id)
	{
		$this->game = Game::findOrFail($id);

		$game['id'] = $this->game->id;
		$game['players'] = [];
		$game['timeouts'] = [];
		$game['play'] = false;
		$game['rounds'] = 10;

		$q_players = DB::table('games_have_players')->where('game_id', $game['id'])->get();
		$p_count = 0;
		foreach ($q_players as $game_have_players) {
			$player = [];
			$id = $game_have_players->player_id;
			if($id < 10){
				$user_id = null;
				$name = 'Robot '.$id;
				$img_src = '/img/bot.png';
				$player['user'] = ['id'=>$id,'user_id'=>$user_id,'name'=>$name,'img_src'=>$img_src];
				$player['online'] = true;
			}else{
				$user_id = Player::find($id)->user_id;
				$name = User::find($user_id)->username;
				$img_src = Person::where('user_id', '=', $user_id)->first()->photo;
				$player['user'] = ['id'=>$id,'user_id'=>$user_id,'name'=>$name,'img_src'=>$img_src];
				$player['online'] = false;
			}
			$player['player_num'] = $game_have_players->player_num;
			$player['dices'] = [];

			$q_score = DB::table('moves')->where('game_id',$game['id'])->where('player_id',$id)->max('id');
			$score = [];
			if($q_score){
				$score['ones'] = $q_score->s_ones;
				$score['twos'] = $q_score->s_twos;
				$score['threes'] = $q_score->s_threes;
				$score['fours'] = $q_score->s_fours;
				$score['fives'] = $q_score->s_fives;
				$score['sixes'] = $q_score->s_sixes;
				$score['bonus'] = $q_score->s_bonus;
				$score['threeKind'] = $q_score->s_threekind;
				$score['fourKind'] = $q_score->s_fourkind;
				$score['house'] = $q_score->s_house;
				$score['small_s'] = $q_score->s_small_s;
				$score['large_s'] = $q_score->s_large_s;
				$score['chance'] = $q_score->s_chance;
				$score['yahtzee'] = $q_score->s_yahtzee;
			}else{
				$score['ones'] = 0;
				$score['twos'] = 0;
				$score['threes'] = 0;
				$score['fours'] = 0;
				$score['fives'] = 0;
				$score['sixes'] = 0;
				$score['sum'] = 0;
				$score['bonus'] = 0;
				$score['threeKind'] = 0;
				$score['fourKind'] = 0;
				$score['house'] = 0;
				$score['small_s'] = 0;
				$score['large_s'] = 0;
				$score['chance'] = 0;
				$score['yahtzee'] = 0;
				$score['total'] = 0;
			}
			$player['score'] = $score;
			$player['r_score'] = $score;
			$player['rollsAvailable'] = 0;

			$game['players'][$p_count] = $player;
			$p_count++;
		}
		$game['turn'] = 0;

		return $game;
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
