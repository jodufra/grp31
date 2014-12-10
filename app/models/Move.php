<?php

class Move extends Eloquent {

	public static $move_types = [
		'ROLL',
		'REROLL',
		'ONES',
		'TWOS',
		'THREES',
		'FOURS',
		'FIVES',
		'SIXES',
		'THREEKIND',
		'FOURKIND',
		'HOUSE',
		'SMALL_S',
		'LARGE_S',
		'CHANCE',
		'YAHTZEE'
	];

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}