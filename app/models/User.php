<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    protected $fillable = ['username', 'email', 'password'];

    public static $create_rules = array(
        'username' => 'required|min:5|max:24|unique:users',
        'email' => 'required|email|min:5|max:24|unique:users',
        'password' => 'required|min:5|max:24|confirmed',
        'password_confirmation' => 'required'
    );

    public static $login_rules = array(
        'username' => 'required',
        'password' => 'required',
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function person()
    {
        return $this->hasOne('Person');
    }


}
