<?php

class Person extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'persons';


    // Add your validation rules here
    public static $rules = [
    'first_name'=>'required|min:2',
    'last_name'=>'required|min:2',
    'birth_date'=>'required',
    'country'=>'required',
    'city'=>'min:4',
    'address'=>'min:12',
    'phone_number'=>'min:9',
    'credit_card_type'=>'required',
    'credit_card_titular'=>'required|min:6',
    'credit_card_num'=>'required|min:13',
    'credit_card_valid_month'=>'required',
    'credit_card_valid_year'=>'required'
    ];

    protected $fillable = [
    'first_name',
    'last_name',
    'birth_date',
    'country',
    'city',
    'address',
    'phone_number',
    'facebook_url',
    'twitter_url',
    'credit_card_type',
    'credit_card_titular',
    'credit_card_num',
    'credit_card_valid_month',
    'credit_card_valid_year',
    'credit_card_valid_cvc'
    ];

    protected $hidden = [
    'photo_url',
    'credit_card_type',
    'credit_card_num',
    'credit_card_valid_month',
    'credit_card_valid_year'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

}
