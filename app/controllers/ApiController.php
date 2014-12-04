<?php

use Yatzhee\Cryptography\Cryptography;

class ApiController extends BaseController {

    /**
     * @var Crypt
     */
    private $crypt;

    public function __construct(Cryptography $crypt) {
        $this->crypt = $crypt;
        $this->afterFilter('cryptOut', array('except'   => 'postInit'));
    }

    public function showHome()
    {
        return View::make('home');
    }

    public function postInit() {
        if (!(Input::has('key') && Input::has('iv'))) {
            return 'ERROR 1';
        }

        extract(Input::only('key', 'iv'));
        $key = $this->crypt->rsaDecrypt($key);
        $iv = $this->crypt->rsaDecrypt($iv);

        if (!($key && $iv)) {
            return 'ERROR 2';
        }
        
        $this->crypt->initAes(array(
            'key'   => $key,
            'iv'    => $iv,
        ));

        return 'OK';
    }
}