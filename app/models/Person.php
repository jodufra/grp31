<?php

class Person extends Eloquent
{
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
    'credit_card_num'=>'required|min:13'
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
    'credit_card_num'];

    protected $hidden = [
    'photo_url',
    'credit_card_type',
    'credit_card_num'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

}
