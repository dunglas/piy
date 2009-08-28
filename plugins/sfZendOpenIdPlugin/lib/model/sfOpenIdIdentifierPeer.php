<?php

/**
 * Subclass for performing query and update operations on the 'sf_openid_identifier' table.
 *
 * 
 *
 * @package plugins.sfZendOpenIdPlugin.lib.model
 */ 
class sfOpenIdIdentifierPeer extends BasesfOpenIdIdentifierPeer
{
  
  /**
   * @return sfOpenIdIdentifier
   */
  public static function retrieveByIdentifier($identifier)
  {
    $c = new Criteria();
    $c->add(self::IDENTIFIER, $identifier);
    
    return self::doSelectOne($c);
  }
}
