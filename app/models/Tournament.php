<?php

class Tournament extends \Eloquent {


	public static $rules = [
		'name' => 'required|min:5|max:29|unique:tournaments',
        'begin' => 'required',
        'ends' => 'required',
        'description' => 'required|min:5|max:300',
        'prize' => 'required|min:5|max:120'
	];


	protected $fillable = ['name','begin','ends','description','prize'];

    public function games()
    {
        return $this->hasMany('TournamentHaveGames', 'tournament_id');
    }
    public function players()
    {
        return $this->hasMany('TournamentHavePlayers', 'tournament_id');
    }

}