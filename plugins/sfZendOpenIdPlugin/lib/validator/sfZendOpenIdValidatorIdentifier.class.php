<?php

/*
 * This file is part of the sfZendOpenIdPlugin
 * (c) 2008 Bouke Haarsma <bouke@haarsma.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Bouke Haarsma <bouke@haarsma.eu>
 * @version    SVN: $Id$
 */
class sfZendOpenIdValidatorIdentifier extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('username_field', 'username');
    $this->addOption('password_field', 'password');
    $this->addOption('remember_checkbox', 'remember');
    $this->addOption('openid_url_field', 'openid_url');
    $this->addOption('throw_global_error', false);

    $this->setMessage('invalid', 'The username and/or password and/or OpenID is invalid.');
  }

  protected function doClean($values)
  {
    $openid_url = isset($values[$this->getOption('openid_url_field')]) ? $values[$this->getOption('openid_url_field')] : '';
    $username = isset($values[$this->getOption('username_field')]) ? $values[$this->getOption('username_field')] : '';
    $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';
    $remember = isset($values[$this->getOption('remember_checkbox')]) ? $values[$this->getOption('remember_checkbox')] : '';
    
    //return array_merge($values, array('identifier' => $identifier));
    
    if(!empty($openid_url)) {
      $username = '';
      $password = '';
      $remember = '';
    } else {
      $openid_url = '';
    }

    if(!empty($openid_url)) {
      return array_merge($values, array('openid_url' => $openid_url, 'username' => $username, 'password' => $password, 'remember' => $remember));
    }
    
    // user exists?
    if ($user = sfGuardUserPeer::retrieveByUsername($username))
    {
      // password is ok?
      if ($user->checkPassword($password))
      {
        return array_merge($values, array('user' => $user));
      }
    }

    if ($this->getOption('throw_global_error'))
    {
      throw new sfValidatorError($this, 'invalid');
    }

    throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
  }
}
