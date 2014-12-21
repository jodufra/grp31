<?php

class Game extends Eloquent{

	public static $rules = [];
	
	protected $fillable = [];

	protected $guarded = ['*'];

	public function players()
	{
		return $this->hasMany('GameHavePlayer', 'game_id');
	}
} 