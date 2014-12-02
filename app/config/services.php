<?php

return array(

    /*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

    'mailgun' => array(
        'domain' => 'sandboxd44870f8b22b44c9b9d99a872990d79a.mailgun.org',
        'secret' => '864efe271e970d633a0cb9c0081159ff',
    ),

    'mandrill' => array(
        'secret' => '',
    ),

    'stripe' => array(
        'model'  => 'User',
        'secret' => '',
    ),

);
