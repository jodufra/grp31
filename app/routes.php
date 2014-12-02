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
    Route::group(array('prefix' => 'user'), function(){
        Route::get('create', array('as' => 'user.create', 'uses' => 'UsersController@create'));
        Route::post('store', array('as' => 'user.store', 'before' => 'csrf', 'uses' => 'UsersController@store'));
    });

    Route::get('login', 'AuthController@getLogin');
    Route::post('login', array('before' => 'csrf', 'uses' => 'AuthController@postLogin'));
    Route::controller('password', 'RemindersController');
});

Route::group(array('before' => 'auth'), function () {
    // Only Users
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@logout'));
    Route::get('user/show', array('as' => 'user.show', 'uses' => 'UsersController@show'));
    Route::group(array('prefix' => 'game'), function(){
        Route::any('/','GameController@scoreCalculator');
        Route::get('getDices','GameController@getDices');
    });
});

Route::group(array('before' => 'not.supported'), function () {
    // Not Supported
    Route::get('user/edit', array('as' => 'user.edit', 'uses' => 'UsersController@edit'));
    Route::put('user/update', array('as' => 'user.update', 'uses' => 'UsersController@update'));
    Route::delete('user/delete', array('as' => 'user.delete', 'uses' => 'UsersController@delete'));

});
