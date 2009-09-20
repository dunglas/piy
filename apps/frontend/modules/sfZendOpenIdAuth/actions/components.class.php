<?php
/**
 * sfZendOpenIdAuth components
 *
 * @package piy
 * @subpackage sfZendOpenIdAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class sfZendOpenIdAuthComponents extends sfComponents {
  /**
   * Signin component
   *
   * @param sfWebRequest $request
   */
  public function executeSignin(sfWebRequest $request) {
    $class = sfConfig::get('app_sf_zend_openid_plugin_signin_form', 'sfZendOpenIdFormSignin');
    $this->form = new $class();
  }
}
