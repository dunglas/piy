<?php
require_once dirname(__FILE__).'/unit.php';
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);

new sfDatabaseManager($configuration);
sfContext::createInstance($configuration);