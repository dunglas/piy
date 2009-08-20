<?php
require_once dirname(__FILE__).'/../../bootstrap/propel.php';
$t = new lime_test(1, new lime_output_color());

$user = sfGuardUserPeer::retrieveByUsername('kevin');
$t->is($user->getEmail(), $user->getProfile()->getEmail(), '::getEmail() act as proxy method for ::getProfile()::getEmail()');
?>