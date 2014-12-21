<?php

class Player extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function games()
	{
		return $this->hasMany('GameHavePlayer', 'player_id');
	}
}