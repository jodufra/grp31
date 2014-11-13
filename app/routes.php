<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHome'));

Route::group(array('before' => 'guest'), function () {
    // Only Guests
    Route::controller('password','RemindersController');
    Route::get('login', 'UsersController@showLogin');
    Route::get('user/create', array('as' => 'user.create', 'uses' => 'UsersController@create'));
    Route::post('user/store', array('as' => 'user.store', 'uses' => 'UsersController@store'));
    Route::post('/', array('as' => 'login', 'uses' => 'UsersController@handleLogin'));
});

Route::group(array('before' => 'auth'), function () {
    // Only Users
    Route::get('user/show', array('as' => 'user.show', 'uses' => 'UsersController@show'));
    Route::any('logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));
    Route::any('game', array('as' => 'game', 'uses' => 'GameController@scoreCalculator'));
});

Route::group(array('before' => 'not.supported'), function () {
    // Not Supported
    Route::get('user/edit', array('as' => 'user.edit', 'uses' => 'UsersController@edit'));
    Route::put('user/update', array('as' => 'user.update', 'uses' => 'UsersController@update'));
    Route::delete('user/delete', array('as' => 'user.delete', 'uses' => 'UsersController@delete'));

});
