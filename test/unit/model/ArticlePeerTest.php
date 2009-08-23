<?php
require_once dirname(__FILE__).'/../../bootstrap/propel.php';
$t = new lime_test(8, new lime_output_color());

$slug = 'welcome-to-publish-it-yourself';
$article1 = ArticlePeer::retrieveBySlug($slug);
$article2 = ArticlePeer::retrieveBySlug(Utils::generateHash());

$user1 = sfGuardUserPeer::retrieveByUsername('kevin');

$t->is($article1->getSlug(), $slug, '::retrieveBySlug() returns the correct Article');
$t->is($article2, false, '::retrieveBySlug() returns false if the Article does no exist');
$t->isa_ok(ArticlePeer::getMostRecent(), 'sfPropelPager', '::getMostRecent() returns a pager');
$t->isa_ok(ArticlePeer::getMostRecentTaggedWith('piy'), 'sfPropelPager', '::getMostRecentTaggedWith() returns a pager');
$t->isa_ok(ArticlePeer::getMostRated(), 'sfPropelPager', '::getMostRated() returns a pager');
$t->isa_ok(ArticlePeer::getMostRatedTaggedWith('piy'), 'sfPropelPager', '::getMostRatedTaggedWith() returns a pager');
$t->isa_ok(ArticlePeer::getPublishedBy($user1), 'sfPropelPager', '::getPublishedBy() returns a pager');
$t->isa_ok(ArticlePeer::getPublishedByTaggedWith($user1, 'piy'), 'sfPropelPager', '::getPublishedBy() returns a pager');
?>