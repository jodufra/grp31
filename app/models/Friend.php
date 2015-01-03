<?php

class Friend extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		'user_id' => 'required',
		'friend_id' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['user_id', 'friend_id', 'updated_at', 'created_at'];

}