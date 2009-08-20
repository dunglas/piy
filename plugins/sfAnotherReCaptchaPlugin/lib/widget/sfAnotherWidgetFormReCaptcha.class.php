<?php
require_once (sfConfig::get('sf_plugins_dir').'/sfAnotherReCaptchaPlugin/lib/vendor/recaptcha/recaptchalib.php');

/**
 * sfWidgetFormReCaptcha create a reCAPTCHA widget (recaptcha.net).
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class sfAnotherWidgetFormReCaptcha extends sfWidgetForm {
	/**
   * Constructor.
   *
   * Available options:
   *
   *  * public_key:        Your reCAPTCHA public key (app_recaptcha_private_key by default)
   *  * error:             A reCAPTCHA error code
   *  * use_ssl:           Use a secure connection (false by default)
   *
   * @param array  $options An array of options
   * @param array  $messages An array of error messages
   *
   * @see sfWidgetForm
   */
	public function __construct($options = array(), $attributes = array())
  {
    $this->addOption('public_key', sfConfig::get('app_recaptcha_public_key'));
    $this->addOption('error', null);
    $this->addOption('use_ssl', false);

    parent::__construct($options, $attributes);
  }
  
  /**
   * Render a reCAPTCHA widget
   *
   * @param null $name Unused, for the method signature
   * @param null $value Unused, for the method signature
   * @param array $attributes
   * @param array $errors
   * @return string
   */
  public function render($name, $value = null, $attributes = array(), $errors = array()) {
  	return recaptcha_get_html($this->getOption('public_key'), $this->getOption('error'), $this->getOption('use_ssl'));
  }
}