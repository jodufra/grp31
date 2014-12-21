<?php

class GameHavePlayer extends Eloquent {
	
	public static $rules = [
		'player_id' => 'required|exists:players,id'
	];

	protected $table = 'games_have_players';

	protected $fillable = ['game_id','player_id','player_num'];	

    public function game()
	{
		return $this->belongsTo('Game');
	}

    public function player()
	{
		return $this->belongsTo('Player');
	}

}