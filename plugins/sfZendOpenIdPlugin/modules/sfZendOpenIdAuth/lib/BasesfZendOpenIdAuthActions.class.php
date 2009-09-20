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
        
        if(!empty($values['openid_url'])) {
           $consumer = new Zend_OpenId_Consumer();
           $consumer->setSession(new sfZendSession("sf_zend_openid"));
   
           $consumer->login($values['openid_url'], $this->getController()->genUrl("@sf_openid_verify", true));
           
           $this->getResponse()->setStatusCode(401);
        } else {
           $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);
            
           // always redirect to a URL set in app.yml
           // or to the referer
           // or to the homepage
           $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer('@homepage'));
   
           return $this->redirect($signinUrl);
        }
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

      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

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

    if ($consumer->verify($request->getParameterHolder()->getAll(), $openid_identifier))
    {
      $this->verifiedCallback($request, $openid_identifier);
    } else {
      $this->unverifiedCallback($request, $openid_identifier);
    }
  }
  
  public function verifiedCallback($request, $openid_url)
  {
    $user = $this->getUser();

    $user_link = sfOpenIdIdentifierPeer::retrieveByIdentifier($request->getParameter("openid_claimed_id"));
    if($user_link) {

      // save last login
      $user_link->setLastLogin(time());
      $user_link->save();
      
      $user->signin($user_link->getsfGuardUser());
      
      // always redirect to a URL set in app.yml
      // or to the referer
      // or to the homepage
      $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer('@homepage'));

      return $this->redirect($signinUrl);
      /*$signinUrl = sfConfig::get('app_sf_zend_openid_plugin_success_signin_url'); //$user->getReferer($request->getReferer()));
      $this->redirect($signinUrl != '' ? $signinUrl : '@homepage');*/
    } else {
      $this->unknownIdentifierCallback($request, $openid_url);
    }
  }

  public function unverifiedCallback($request, $openid_url)
  {
    $this->redirect("@sf_openid_signin");
  }

  public function unknownIdentifierCallback($request, $openid_url)
  {
    if(sfConfig::get("app_sf_zend_open_id_plugin_allow_linking", false)) {
      $this->forward404If(sfGuardUserPeer::retrieveByUsername($openid_url, null));

      $user = new sfGuardUser();
      $user->setUsername($openid_url);
      $user->save();

      $user_link = new sfOpenIdIdentifier();
      $user_link->setUserId($user->getId());
      $user_link->setIdentifier($openid_url);
      $user_link->save();

      $this->getUser()->signIn($user);

      $signinUrl = sfConfig::get("app_sf_guard_plugin_success_signin_url", $this->getUser()->getReferer("@homepage"));
      return $this->redirect($signinUrl);
    } else {
      throw new Exception("Although a valid OpenID, it is not linked. Enable linking in app.yml (sf_zend_open_id_plugin_allow_linking: true)");
    }
  }

  
  
  public function executeLinkUser($request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated() || is_null($this->getUser()->getAttribute("temp_openid_url")))
    {
      return $this->redirect('@homepage');
    }

    $class = sfConfig::get('app_sf_openid_link_user_form', 'sfOpenIdLinkUserForm');
    $this->linkUserForm = new $class();

    if ($request->isMethod('post'))
    {
      $this->linkUserForm->bind($request->getParameter('link_user'));

      if ($this->linkUserForm->isValid())
      {
        $values = $this->linkUserForm->getValues();
        
        $this->getUser()->signin($values['user'], false);
        
        $user_link = new sfOpenIdIdentifier();
        $user_link->setUserId($values['user']->getId());
        $user_link->setIdentifier($this->getUser()->getAttribute("temp_openid_url"));
        $user_link->save();
        
        $this->getUser()->setAttribute("temp_openid_url", null);
        
        // always redirect to a URL set in app.yml
        // or to the referer
        // or to the homepage
        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer('@homepage'));
        return $this->redirect($signinUrl);
      }
    }
  }
}
