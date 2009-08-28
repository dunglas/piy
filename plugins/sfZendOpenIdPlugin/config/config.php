<?php

if (sfConfig::get('app_sf_zend_openid_plugin_routes_register', true) && in_array('sfZendOpenIdAuth', sfConfig::get('sf_enabled_modules', array())))
{
  $this->dispatcher->connect('routing.load_configuration', array('sfZendOpenIdRouting', 'listenToRoutingLoadConfigurationEvent'));
}

if (in_array("sfOpenIdIdentifier", sfConfig::get('sf_enabled_modules')))
{
  $this->dispatcher->connect('routing.load_configuration', array('sfZendOpenIdRouting', 'addRouteForAdminOpenIdIdentifier'));
}
