<?php

Validator::extend('olderThan', function($attribute, $value, $parameters)
{
    $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 18;
    return (new DateTime)->diff(new DateTime($value))->y >= $minAge;
});
Validator::extend('validCreditCard', function($attribute, $value, $parameters)
{
    $todayYear=(new DateTime())->format("Y");
    $todayMonth=(new DateTime())->format("m");
    $cMonth=$parameters[0];
    $bool = ($value<$todayYear || $value==$todayYear && $cMonth<$todayMonth ) ? false : true;
    return $bool;
});


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

    public static $messages = array(
        'older_than'    => 'You need to have more than 18 years old',
        'valid_credit_card' => 'The expiration date is invalid',
    );

	// Add your validation rules here
	public static $rules = [
		'photo_file' => 'image',
		'first_name' => 'required|min:2',
		'last_name' => 'required|min:2',
		'birth_date' => 'required|olderThan:18',
		'country' => 'required',
		'address' => 'min:12',
		'phone' => 'min:9',
        'credit_card_type'=>'required',
		'credit_card_titular' => 'required|min:6',
		'credit_card_num' => 'required|min:13',
		'credit_card_valid_month' => 'required',
		'credit_card_valid_year' => 'required|validCreditCard:credit_card_valid_year:credit_card_valid_month',
	];

	public static $rulesUpdate = [
		'photo_file' => 'image',
		'name_update' => 'required|min:2',
//		'last_name' => 'required|min:2',
//		'country' => 'required',
		'address' => 'min:12',
		'phone' => 'min:9',
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
