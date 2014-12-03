<?php namespace Yatzhee\Cryptography;

use Yatzhee\Helpers\Base64;

/**
 * Provides funcitonality for getting decrypted Input paramters
 * (encrypted with AES)
 * Class DecryptedInput
 * @package Yatzhee\Cryptography
 */
class DecryptedInput {

    /**
     * Array of raw (non-decrypted) input parameters
     * @var array
     */
    protected $params;

    /**
     * Array of decrypted values
     * @var array
     */
    protected $decryptedParams = array();

    /**
     * @var Cryptography
     */
    protected $crypt;

    /**
     * @param Cryptography $crypt Injected Cryptography object used for decrypting
     */
    public function __construct(Cryptography $crypt) {
        $this->crypt = $crypt;
        $this->params = \Input::all();
    }

    /**
     * Returns decrypted input parameter
     * @param $key
     * @return String
     */
    public function get($key) {
        if (isset($this->decryptedParams[$key])) {
            return $this->decryptedParams[$key];
        }

        $value = $this->crypt->aesDecrypt(Base64::UrlDecode($this->params[$key]));
        $this->decryptedParams[$key] = $value;

        return $value;
    }

    /**
     * Returns all input params decrypted
     * @return array
     */
    public function all() {
        foreach ($this->params as $key => $value) {
            $this->decryptedParams[$key] = $this->get($key);
        }

        return $this->decryptedParams;
    }

    /**
     * Returns only specified input parameters
     * @return array
     */
    public function only() {
        $args = func_get_args();
        $result = array();
        foreach($args as $arg) {
            $result[$arg] = $this->get($arg);
        }

        return $result;
    }

}