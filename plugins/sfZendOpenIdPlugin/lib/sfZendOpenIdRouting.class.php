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

class sfZendOpenIdRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('sf_zend_openid_signin', new sfRoute('/openid_login', array('module' => 'sfZendOpenIdAuth', 'action' => 'signin')));
    $r->prependRoute('sf_zend_openid_verify', new sfRoute('/openid_verify', array('module' => 'sfZendOpenIdAuth', 'action' => 'verify')));
  }



  static public function addRouteForAdminOpenIdIdentifier(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_openid_identifier', new sfPropelRouteCollection(array(
      'name'                 => 'sf_openid_identifier',
      'model'                => 'sfOpenIdIdentifier',
      'module'               => 'sfOpenIdIdentifier',
      'prefix_path'          => 'sf_openid_identifier',
      'with_wildcard_routes' => true,
      'requirements'         => array(),
    )));
  }
}
