<?php namespace Yatzhee\Dto\Responses;

class LoginResponse extends ResponseBase {

    const LOGIN_SUCCESS = true;
    const LOGIN_FAIL = false;

    public $loginResult;
    public $expire; 

    public function __construct() {
        $this->type = 'login';
        $this->expire = '0000-00-00 00:00:00';
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return [
            'type'          => $this->type,
            'loginResult'   => $this->loginResult,
            'expire'        => $this->expire,
        ];
    }
}