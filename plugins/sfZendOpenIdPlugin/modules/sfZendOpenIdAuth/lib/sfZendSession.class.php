<?php

/*
 * This file is part of the sfZendOpenIdPlugin
 * (c) 2008 Krešo Kunjas <kkunjas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * This file is used within sfZendOpenIdPlugin with permission of the author 
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Krešo Kunjas <kkunjas@gmail.com>
 * @version    SVN: $Id$
 */

class sfZendSession extends Zend_Session_Namespace
{ 
  private $session = null, $ns = ''; 

  public function __construct($ns) 
  { 
    $this->ns = $ns; 
    $this->session = sfContext::getInstance()->getUser(); 
  } 

  public function __set($name,$val) 
  { 
    $this->session->setAttribute($name,$val); 
  } 
  public function & __get($name) 
  { 
    return $this->session->getAttribute($name); 
  } 

}
