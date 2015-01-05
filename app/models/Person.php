<?php

class Person extends Eloquent
{
	protected $attributes = array(
		'photo' => '/img/default.png',
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'people';


	// Add your validation rules here
	public static $rules = [
		'photo_file' => 'image',
		'first_name' => 'required|min:2',
		'last_name' => 'required|min:2',
		'birth_date' => 'required',
		'country' => 'required',
		'address' => 'min:12',
		'phone' => 'min:9',
		'facebook_url'=>'url',
		'twitter_url'=>'url',
		'credit_card_titular' => 'required|min:6',
		'credit_card_num' => 'required|min:13',
		'credit_card_valid_month' => 'required',
		'credit_card_valid_year' => 'required',
	];

	public static $rulesUpdate = [
		'photo_file' => 'image',
		'name_update' => 'min:2',
//		'last_name' => 'required|min:2',
//		'country' => 'required',
		'address' => 'min:12',
		'phone' => 'min:9',
		'facebook_url'=>'url',
		'twitter_url'=>'url',
//		'credit_card_titular' => 'required|min:6',
//		'credit_card_num' => 'required|min:13',
//		'credit_card_valid_month' => 'required',
//		'credit_card_valid_year' => 'required',
	];

	protected $fillable = [
		'name',
		'photo',
		'birthdate',
		'country',
		'address',
		'phone',
		'facebook_url',
		'twitter_url',
		'credit_card_titular',
		'credit_card_num',
		'credit_card_valid',
	];

	protected $hidden = [
		'credit_card_num',
		'credit_card_valid',
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

}
