<?php

class Game extends Eloquent{
    protected $guarded = array();

    public static $rules = array(
        'name' => 'required'
    );

	public function players()
	{
		return $this->hasMany('GameHavePlayer', 'game_id');
	}
} 