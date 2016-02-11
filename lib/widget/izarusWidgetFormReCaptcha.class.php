<?php

class izarusWidgetFormRecaptcha extends sfWidgetForm {

  public function configure($options = array(), $attributes = array())
  {
    $this->addOption('site_key');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $template = <<<EOF
<script src="https://www.google.com/recaptcha/api.js"></script>
<div class="g-recaptcha" data-sitekey="%site_key%"></div>
EOF;

    return strtr($template,array(
      '%site_key%' => $this->getOption('site_key'),
      ));
  }

}
