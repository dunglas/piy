<?php
require_once (sfConfig::get('sf_plugins_dir').'/sfAnotherReCaptchaPlugin/lib/vendor/recaptcha/recaptchalib.php');

/**
 * sfValidatorSchemaReCaptcha validates a reCAPTCHA (recaptcha.net).
 *
 * @author Arthur Koziel <arthur@arthurkoziel.com>
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class sfAnotherValidatorSchemaReCaptcha extends sfValidatorSchema
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * private_key:        Your reCAPTCHA private key (app_recaptcha_private_key by default)
   *  * throw_global_error: Whether to throw a global error (false by default) or an error tied to the response field
   *
   * @param sfForm $form The form to validate 
   * @param string $captchaField The name of the sfWidgetFormReCaptcha
   * @param array  $options An array of options
   * @param array  $messages An array of error messages
   *
   * @see sfValidatorBase
   */
  public function __construct($form, $captchaField, $options = array(), $messages = array())
  {
  	$this->addOption('form', $form);
    $this->addOption('captcha_field', $captchaField);
    
    $this->addOption('private_key', sfConfig::get('app_recaptcha_private_key'));
    $this->addOption('throw_global_error', false);

    parent::__construct(null, $options, $messages);
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  { 
    if (!is_array($values))
    {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
    }
      
    $resp = recaptcha_check_answer ($this->getOption('private_key'),
                                    $_SERVER['REMOTE_ADDR'],
                                    $_POST['recaptcha_challenge_field'],
                                    $_POST['recaptcha_response_field']
    );

    if (!$resp->is_valid)
    {
    	$this->getOption('form')->getWidget($this->getOption('captcha_field'))->setOption('error', $resp->error);
    	
    	switch ($resp->error) {
    		case 'incorrect-captcha-sol':
    			$message = 'The CAPTCHA solution is incorrect.';
    		break;
    		
    		case 'invalid-site-public-key':
          $message = 'We weren\'t able to verify the public key.';
        break;
        
        case 'invalid-site-private-key':
          $message = 'We weren\'t able to verify the private key.';
        break;
        
        case 'invalid-request-cookie':
        	$message = 'The challenge parameter of the verify script was incorrect.';
        break;
        
        case 'verify-params-incorrect':
          $message = 'The parameters to /verify were incorrect, make sure you are passing all the required parameters.';
        break;
        
        case 'invalid-referrer':
          $message = 'reCAPTCHA API keys are tied to a specific domain name for security reasons.';
        break;
        
        case 'recaptcha-not-reachable':
          $message = 'Unable to contact the reCAPTCHA verify server.';
        break;
    		
    		case 'unknown':
    		default:
    			$message = 'Unknow error.';
    		break;
    	}
    	
      $error = new sfValidatorError($this, $message, array(
        'captcha_field' => $this->getOption('captcha_field')
      ));
      if ($this->getOption('throw_global_error'))
      {
        throw $error;
      }

      throw new sfValidatorErrorSchema($this, 
        array($this->getOption('captcha_field') => $error)
      );
    }

    return $values;
  }

  /**
   * @see sfValidatorBase
   */
  public function asString($indent = 0)
  {
    throw new Exception('Unable to convert a sfValidatorSchemaReCaptcha to string.');
  }
}