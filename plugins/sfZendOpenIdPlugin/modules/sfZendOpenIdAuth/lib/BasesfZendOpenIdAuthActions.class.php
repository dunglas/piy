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
class BasesfZendOpenIdAuthActions extends sfActions
{
  public function executeSignin($request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      return $this->redirect('@homepage');
    }

    $class = sfConfig::get('app_sf_zend_openid_plugin_signin_form', 'sfZendOpenIdFormSignin');
    $this->form = new $class();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();

        $consumer = new Zend_OpenId_Consumer();
        $consumer->setSession(new sfZendSession("sf_zend_openid"));

        $consumer->login($values['openid_url'], $this->getController()->genUrl("@sf_zend_openid_verify", true));
        
        $this->getResponse()->setStatusCode(401);
      }
    }
    else
    {
      if ($request->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      $user->setReferer($request->getReferer());

      /** Enable both OpenID-login and username/password
      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }*/

      $this->getResponse()->setStatusCode(401);
    }
  }
  
  public function executeVerify($request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      return $this->redirect('@homepage');
    }

    $consumer = new Zend_OpenId_Consumer();

    if ($consumer->verify($request->getParameterHolder()->getAll(), $opendid_identifier))
    {
      $this->verifiedCallback($request);
    } else {
      $this->unverifiedCallback($request);
    }
  }
  
  public function verifiedCallback($request)
  {
    $user = $this->getUser();
   
    if($user_link = sfOpenIdIdentifierPeer::retrieveByIdentifier($request->getParameter("openid_claimed_id"))) {

      // save last login
      $user_link->setLastLogin(time());
      $user_link->save();
      
      $user->signin($user_link->getsfGuardUser());
      
      $signinUrl = sfConfig::get('app_sf_zend_openid_plugin_success_signin_url'); //$user->getReferer($request->getReferer()));
      $this->redirect($signinUrl != '' ? $signinUrl : '@homepage');
    } else {
      $this->unknownIdentifierCallback($request);
    }
  }

   public function unverifiedCallback($request)
   {
      $this->redirect("@sf_zend_openid_signin");
   }
   
   public function unknownIdentifierCallback($request)
   {
     if(sfConfig::get("app_sf_zend_open_id_plugin_allow_linking", false)) {
       throw new Exception("Not yet implemented");
     } else {
       throw new Exception("Although a valid OpenID, it is not linked. Enable linking in app.yml (sf_zend_open_id_plugin_allow_linking: true)");
     }
   }
}
