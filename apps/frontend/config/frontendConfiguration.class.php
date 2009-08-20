<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
  	parent::initialize();
  	
  	require_once(sfConfig::get('sf_plugins_dir').'/sfXssSafePatchedPlugin/lib/vendor/htmlpurifier/HTMLPurifier/Bootstrap.php');
  	spl_autoload_register(array('HTMLPurifier_Bootstrap', 'autoload'));
  }
}
