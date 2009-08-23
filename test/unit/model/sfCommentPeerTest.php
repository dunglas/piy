<?php
require_once dirname(__FILE__).'/../../bootstrap/propel.php';
$t = new lime_test(1, new lime_output_color());

$user1 = sfGuardUserPeer::retrieveByUsername('kevin');

$t->isa_ok(sfCommentPeer::getPublishedBy($user1), 'sfPropelPager', '::getPublishedBy() returns a pager');
?>