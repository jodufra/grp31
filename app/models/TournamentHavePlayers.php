<?php

class TournamentHavePlayers extends Eloquent {
	


	protected $table = 'tournament_have_players';

	protected $fillable = ['tournament_id','player_id','position'];

    public function tournament()
	{
		return $this->belongsTo('Tournament');
	}

    public function player()
	{
		return $this->belongsTo('Player');
	}

}