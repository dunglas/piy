<?php
class sfGuardAuthComponents extends sfComponents {
	public function executeSignin() {
		$class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
    $this->form = new $class();
	}
}