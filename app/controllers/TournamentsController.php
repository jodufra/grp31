<?php

class TournamentsController extends \BaseController {

	/**
	 * Display a listing of tournaments
	 *
	 * @return Response
	 */
	public function index()
	{
		$tournaments = Tournament::orderBy('begin','DESC')->get();

		return View::make('tournaments.index', compact('tournaments'));
	}

	/**
	 * Show the form for creating a new tournament
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tournaments.create');
	}

	/**
	 * Store a newly created tournament in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $data['begin']= new DateTime($data['begin']);
        $data['ends']= new DateTime($data['ends']);
        if($data['begin']<=(new DateTime()))
            return Redirect::route('tournaments.create')->withInput()->with('danger','The begin date is less or equal than today date, players need time to subscribe!');
        if( $data['ends']<(new DateTime()))
            return Redirect::route('tournaments.create')->withInput()->with('danger','The end date is less than today date!');
        if( $data['ends']<$data['begin'])
            return Redirect::route('tournaments.create')->withInput()->with('danger','The end date is less than begin date!');

        if($data['begin']<(new DateTime()))return Redirect::route('tournaments.create')->withInput()->with('danger','The begin date is less than today date!');

		$validator = Validator::make($data, Tournament::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Tournament::create($data);

		return Redirect::route('tournaments.index');
	}
    public function subscribe($id){
        $tournaments= Tournament::find((int)$id)->players()->get();
        foreach ($tournaments as $value){
            $player = Player::find(Auth::user()->player()->first()->id);
            if($player->id==$value->player_id) return Redirect::route('tournaments.index')->with('danger','You already had joined in this tournament!');
        }
        if(Auth::user()->player()->first()->id)
       $tournament_have_players= array('tournament_id'=>(int)$id,'player_id'=>Auth::user()->player()->first()->id,'position'=>0 );
        TournamentHavePlayers::create($tournament_have_players);
        return Redirect::route('tournaments.index')->with('info','You had joined with success!');
    }

	/**
	 * Display the specified tournament.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function showRanking($id){
        $users= Array();
        $tournaments = Tournament::findOrFail($id)->players()->orderBy('position','DESC')->get();
        foreach ($tournaments as $value){
            $player = Player::find($value->player_id);
            $user = User::find($player->user_id);
            array_push($users,$user);
        }

        return View::make('tournaments.results', compact('users'));
    }
    public function start($id){
        $users= Array();
        $tournaments = Tournament::findOrFail($id)->players()->get();
        $numberOfElements=count($tournaments);
            if($numberOfElements<=1)return Redirect::route('tournaments.index')->with('danger','Impossible, don\'t have sufficient players!');
        $a=0;
        for($i=0;$i<32;$i++){
            $a=2^$i;
            if($numberOfElements<=$a){
                break;
            }
        }
        $i=1;
        foreach ($tournaments as $value){
            if($i%2!=0)
                $game = array('name'=>'Game'+$i);
           $newGame= Game::create($game);
            $gameHavePlayer=array('game_id'=>$newGame->id,'player_id'=>$value->player_id,'player_num'=>($i%2!=0)?1:2);
            GameHavePlayer::create($gameHavePlayer);
            $i++;
        }
        for($i;$i<$a;$i++){
            if($i%2!=0)
                $game = array('name'=>'Game'+$i);
            $newGame= Game::create($game);
            $gameHavePlayer=array('game_id'=>$newGame->id,'player_id'=>$value->player_id,'player_num'=>($i%2!=0)?1:2);
            GameHavePlayer::create($gameHavePlayer);
        }
        return Redirect::route('tournaments.index')->with('info','You had started the tournament with success!');
    }
	public function show($id)
	{
        $users= Array();
        $tournaments = Tournament::findOrFail($id)->players()->get();
        foreach ($tournaments as $value){
            $player = Player::find($value->player_id);
            $user = User::find($player->user_id);
            array_push($users,$user);
        }

        return View::make('tournaments.show', compact('users'));
		//return View::make('tournaments.show', compact('users'));
	}

	/**
	 * Show the form for editing the specified tournament.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tournament = Tournament::find($id);

		return View::make('tournaments.edit', compact('tournament'));
	}

	/**
	 * Update the specified tournament in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$tournament = Tournament::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Tournament::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$tournament->update($data);

		return Redirect::route('tournaments.index');
	}

	/**
	 * Remove the specified tournament from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Tournament::destroy($id);

		return Redirect::route('tournaments.index');
	}

}
