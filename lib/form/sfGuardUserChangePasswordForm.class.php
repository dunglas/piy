<?php
/**
 * Changes the user password
 *
 * @package package
 * @subpackage subpackage
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class sfGuardUserChangePasswordForm extends sfGuardUserForm {
  public function configure() {
    parent::configure();
    
    unset($this['username']);
  }
}