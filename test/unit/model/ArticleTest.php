<?php
require_once dirname(__FILE__).'/../../bootstrap/propel.php';
$t = new lime_test(4, new lime_output_color());

$article1 = ArticlePeer::retrieveBySlug('welcome-to-publish-it-yourself');
$article2 = ArticlePeer::retrieveBySlug('anonymous-author');
$article3 = ArticlePeer::retrieveBySlug('not-registered-author');

$user1 = sfGuardUserPeer::retrieveByUsername('kevin');
$user2 = sfGuardUserPeer::retrieveByUsername('aude');

$t->is($article1->__toString(), $article1->getTitle(), '::toString() returns the title');
$t->is($article1->getAuthor(), $article1->getsfGuardUser()->__toString(), '::getAuthor() returns the sfGuardUser name if the author was registered');
$t->is($article2->getAuthor(), 'Anonymous', '::getAuthor() returns anonymous if the user is anonymous');
$t->is($article3->getAuthor(), 'Not registered', '::getAuthor() returns the author name if filled and not registered');
?>