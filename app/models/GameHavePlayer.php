<?php

class GameHavePlayer extends Eloquent {
	
	protected $table = 'games_have_players';

	protected $fillable = ['game_id','player_id','player_num'];
}