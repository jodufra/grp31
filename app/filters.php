<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    if(!Request::secure()) return Redirect::secure(Request::path(),'307');
});

App::after(function ($request, $response) {
    //
});

App::missing(function($exception)
{
    return Redirect::route('home')->with('warning', '404 > Sorry. We couldn\'t find '.Request::url());
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        } else {
            return Redirect::guest('login')->with('warning','401 > You have to login first.');
        }
    }
});


Route::filter('auth.basic', function () {
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
    if (Auth::check())
        return Redirect::route('home')->with('warning','401 > You are logged in. We are pretty sure you don\'t want to go there');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
    if (Session::token() != Input::get('_token')) {
        return Redirect::route('home')->with('danger','You have been exposed to a Cross-Site Request Forgery, for more information click <a href="http://en.wikipedia.org/wiki/Cross-site_request_forgery">here</a>');
    }
});


Route::filter('not.supported', function () {
    return Redirect::route('home')->with('info', 'We are still working on this functionality');
});
