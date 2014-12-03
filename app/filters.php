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
    $headers=array('key' => '-----BEGIN CERTIFICATE-----
        MIICvjCCAiegAwIBAgIJAO52hdsvK4RWMA0GCSqGSIb3DQEBBQUAMHcxCzAJBgNV
        BAYTAlBUMREwDwYDVQQIDAhQb3J0dWdhbDEPMA0GA1UEBwwGTGVpcmlhMSEwHwYD
        VQQKDBhJUEwsIEVTVEcsIERhZCwgR3J1cG8gMzExETAPBgNVBAsMCEdydXBvIDMx
        MQ4wDAYDVQQDDAVncnAzMTAgFw0xNDEyMDMwNDE0NTZaGA8zMDE0MDQwNTA0MTQ1
        NlowdzELMAkGA1UEBhMCUFQxETAPBgNVBAgMCFBvcnR1Z2FsMQ8wDQYDVQQHDAZM
        ZWlyaWExITAfBgNVBAoMGElQTCwgRVNURywgRGFkLCBHcnVwbyAzMTERMA8GA1UE
        CwwIR3J1cG8gMzExDjAMBgNVBAMMBWdycDMxMIGfMA0GCSqGSIb3DQEBAQUAA4GN
        ADCBiQKBgQClUva65ZqtIDmWmRoWOoIyE6ds5MpnkImkgC+8d2oHrtWPIlTTU+Wl
        12thoeDNh4pxjASYU/2DJ1RmaXkaIkl4twbeL3Q2Bt7NWzw4za9kPka2G3l5i0SN
        9LfWzGt0S1yCkktI2qJw+M1bSXot8StwBFktWQgGIzgwG2lVbKEK2wIDAQABo1Aw
        TjAdBgNVHQ4EFgQUfFSQl02zG/3nc3Ww3gkdO9Ic2JQwHwYDVR0jBBgwFoAUfFSQ
        l02zG/3nc3Ww3gkdO9Ic2JQwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOB
        gQCTC0p7XcW++L+sHsVV2DxneFlTyVXpK8+ewWwjnjOAKrA9yFj/tVdZ4+dhDZVx
        PyoU7xpTBMib9tmzC7FEM4Lxb7DlmjYI2kLCju0INBswX7Izv2wQTHYtWbKXDZli
        RlxQyCa8Y2j+JpinkVnnipZ7mBVyyXrtv2VnwMa2fPkNlA==
        -----END CERTIFICATE-----');

     View::share('headers', $headers);
}); 

App::after(function ($request, $response) {
    //
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
            return Redirect::guest('login')->with('warning','You have to login first.');
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
        return Redirect::route('home')->with('warning','You are logged in. We are pretty sure you don\'t want to go there');
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
        return Redirect::route('home')->with('danger','You have been Hacked!!');
        throw new Illuminate\Session\TokenMismatchException;
    }
});


Route::filter('not.supported', function () {
    return Redirect::route('home')->with('info', 'We are still working on this functionality');
});


/*
|--------------------------------------------------------------------------
| Cipher Protection Filter
|--------------------------------------------------------------------------
|
| The Cipher filter is responsible for protecting critical user information (passwords, email)
|
*/
Route::filter('cryptOut', 'Yatzhee\Filters\OutgoingCryptFilter');
