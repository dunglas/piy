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
    $this->addOption('openid_url_field', 'openid_url');
    $this->addOption('throw_global_error', false);

    $this->setMessage('invalid', 'The OpenId identifier is incorrect.');
  }

  protected function doClean($values)
  {
    $identifier = isset($values[$this->getOption('openid_url_field')]) ? $values[$this->getOption('openid_url_field')] : '';
   
    return array_merge($values, array('identifier' => $identifier));

    /*// user exists?
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

    throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));*/
  }
}
