<?php
/**
 * @file
 * Helper class to generate oauth header string.
 */

/**
 * Class to build Cardinity Oatuh header.
 */
class CommerceCardinityOAuth {

  private $secrets;
  private $action;
  public $path;
  private $parameters;

  /**
   * Constructor.
   *
   * @param string $consumer_key
   *   The Consumer key.
   * @param string $consumer_secret
   *   The Consumer secret.
   */
  public function __construct($consumer_key, $consumer_secret) {

    $this->secrets['consumer_key'] = $consumer_key;
    $this->secrets['consumer_secret'] = $consumer_secret;

    $this->parameters = array(
      'oauth_consumer_key' => $this->secrets['consumer_key'],
      'oauth_signature_method' => 'HMAC-SHA1',
      'oauth_timestamp' => time(),
      'oauth_nonce' => sha1(time()),
      'oauth_version' => '1.0',
    );

    return $this;
  }

  /**
   * Set the "action" for the url, (e.g. GET, POST, PATCH, etc.).
   *
   * @param string $action
   *   HTTP Action word.
   *
   * @return object
   *   CommerceCardinityOAuth
   */
  public function setAction($action) {
    if (empty($action)) {
      $action = 'GET';
    }

    $this->action = strtoupper($action);

    return $this;
  }

  /**
   * Set the target URL (does not include the parameters).
   *
   * @param string $path
   *   Oauth target URL.
   *
   * @return object
   *   CommerceCardinityOAuth
   */
  public function setPath($path) {
    $this->path = $path;

    return $this;
  }

  /**
   * Sign the request.
   *
   * @return object
   *   CommerceCardinityOAuth
   */
  public function sign() {
    $norm_params = $this->normalizedParameters();
    $this->parameters['oauth_signature'] = $this->generateSignature($norm_params);

    return $this;
  }

  /**
   * Return a formatted "header" string.
   *
   * @return string
   *   Header string
   */
  public function getHeaderString() {
    if (empty($this->parameters['oauth_signature'])) {
      $this->sign();
    }

    $result = 'OAuth ';

    foreach ($this->parameters as $name => $value) {
      if (strpos($name, 'oauth_') !== 0) {
        continue;
      }
      if (is_array($value)) {
        foreach ($value as $val) {
          $result .= $name . '="' . self::oauthEscape($val) . '", ';
        }
      }
      else {
        $result .= $name . '="' . self::oauthEscape($value) . '", ';
      }
    }

    return preg_replace('/, $/', '', $result);
  }

  /**
   * Escape string.
   */
  private static function oauthEscape($string) {
    if ($string === 0) {
      return 0;
    }
    if ($string == '0') {
      return '0';
    }
    if (strlen($string) == 0) {
      return '';
    }
    if (is_array($string)) {
      return '';
    }
    $string = urlencode($string);

    // FIX: urlencode of ~ and '+'.
    $string = str_replace(array('%7E', '+'), array('~', '%20'), $string);

    return $string;
  }

  /**
   * Normalize parameters.
   */
  private function normalizedParameters() {
    $normalized_keys = array();
    $return_array    = array();

    foreach ($this->parameters as $name => $value) {
      if (!preg_match('/\w+_secret/', $name) OR (strpos($value, '@') !== 0 && !file_exists(substr($value, 1)))) {
        if (is_array($value)) {
          $normalized_keys[self::oauthEscape($name)] = array();
          foreach ($value as $item) {
            array_push($normalized_keys[self::oauthEscape($name)], self::oauthEscape($item));
          }
        }
        else {
          $normalized_keys[self::oauthEscape($name)] = self::oauthEscape($value);
        }
      }
    }

    ksort($normalized_keys);

    foreach ($normalized_keys as $key => $val) {
      if (is_array($val)) {
        sort($val);
        foreach ($val as $element) {
          array_push($return_array, $key . "=" . $element);
        }
      }
      else {
        array_push($return_array, $key . '=' . $val);
      }

    }

    return implode("&", $return_array);
  }

  /**
   * Generate signature.
   */
  private function generateSignature($parameters = "") {

    $secret_key = self::oauthEscape($this->secrets['consumer_secret']);

    $secret_key .= '&';

    $parameters = urlencode($parameters);

    $this->sbs = self::oauthEscape($this->action) . '&' . self::oauthEscape($this->path) . '&' . $parameters;

    return base64_encode(hash_hmac('sha1', $this->sbs, $secret_key, TRUE));
  }

}
