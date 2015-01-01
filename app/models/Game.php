<?php

class Game extends Eloquent{
    protected $guarded = array();

    public static $rules = array(
        'players_count' => 'numeric|required|min:2|max:10',
        'player_is_user' => 'boolean:true|required'
    );

	public function players()
	{
		return $this->hasMany('GameHavePlayer', 'game_id');
	}
} 