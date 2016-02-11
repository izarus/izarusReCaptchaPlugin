<?php

/**
 * Description of izarusValidatorRecaptcha
 */
class izarusValidatorRecaptcha extends sfValidatorBase {

  public function configure($options = array(), $messages = array())
  {
    $this->addOption('secret');
  }

  public function doClean($value) {

    if (is_null($value) && isset($_REQUEST['g-recaptcha-response'])) {
      $value = $_REQUEST['g-recaptcha-response'];
    }

    $reCaptcha = new ReCaptcha($this->getOption('secret'));
    $response = $reCaptcha->verifyResponse(
      $_SERVER["REMOTE_ADDR"],
      $value
    );
    if ($response == null || !$response->success) {
      throw new sfValidatorError($this, 'invalid');
    }
    return $value;
  }

  public function isEmpty($value) {
    return false;
  }

}
