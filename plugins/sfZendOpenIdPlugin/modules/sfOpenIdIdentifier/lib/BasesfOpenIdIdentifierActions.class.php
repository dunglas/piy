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
 * @package    sfZendOpenIdPlugin
 * @subpackage plugin
 * @author     Bouke Haarsma <bouke@haarsma.eu>
 * @version    SVN: $Id$
 */
class BasesfOpenIdIdentifierActions extends autoSfOpenIdIdentifierActions
{
  public function validateEdit()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST && !$this->getRequestParameter('id'))
    {
      if ($this->getRequestParameter('sf_open_id_identifier[user_id]') == '')
      {
        $this->getRequest()->setError('sf_open_id_identifier{user_id}', 'User is mandatory');

        return false;
      }
      if ($this->getRequestParameter('sf_open_id_identifier[identifier]') == '')
      {
        $this->getRequest()->setError('sf_open_id_identifier{identifier}', 'OpenId Identifier is mandatory');

        return false;
      }
    }

    return true;
  }
}
