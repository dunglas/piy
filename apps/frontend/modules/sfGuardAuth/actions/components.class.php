<?php
/**
 * sfGuardAuth components
 */
class sfGuardAuthComponents extends sfComponents {
  /**
   * Signin components
   *
   * @param sfWebRequest $request
   */
	public function executeSignin(@param sfWebRequest $request) {
		$class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
    $this->form = new $class();
	}
}