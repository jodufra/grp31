<?php namespace Yatzhee\Filters;

use Yatzhee\Cryptography\Cryptography;
use Yatzhee\Helpers\Base64;

/**
 * Class OutgoingCryptFilter
 * Encrypts and signs the response
 *
 * @package Yatzhee\Filters
 */
class OutgoingCryptFilter {

  private $crypt;

  public function __construct(Cryptography $crypt) {
    $this->crypt = $crypt;
  }

  public function filter($route, $request, $response) {
    $content = $response->getOriginalContent();
    if (!is_string($content)) {
      $content = json_encode($content);
    }

    $content = Base64::UrlEncode($this->crypt->aesEncrypt($content));
    $sign = Base64::UrlEncode($this->crypt->rsaSign($content));

    $json = ['data' => $content, 'sign' => $sign];

    $response->setContent($json);
  }
}