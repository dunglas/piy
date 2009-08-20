<?php
class sfPropelActAsTaggableBehaviorPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php');
    return parent::initialize();
  }
}