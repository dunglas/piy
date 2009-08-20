<?php
require_once dirname(__FILE__).'/../../bootstrap/propel.php';
$t = new lime_test(7, new lime_output_color());

$article = ArticlePeer::retrieveBySlug('welcome-to-self-publish');
$t->is($article->__toString(), $article->getTitle(), '::toString() return the title');

$user1 = sfGuardUserPeer::retrieveByUsername('kevin');
$user2 = sfGuardUserPeer::retrieveByUsername('aude');

$init_nb_promo = $article->countPromotions();
$article->promote($user1);
$end_nb_promo = $article->countPromotions();
$t->is($end_nb_promo, $init_nb_promo + 1, '::promote() add a promotion and ::countPromotions() works');

$article->promote($user1);
$one_time = $article->countPromotions();
$t->is($one_time, $end_nb_promo, '::promote() A user can promote an article only one time');

$init_nb_demo = $article->countDemotions();
$article->demote($user1);
$end_nb_demo = $article->countDemotions();
$t->is($init_nb_demo, $end_nb_demo, '::demote() A user cannot demote if he has already promoted');

$init_nb_demo = $article->countDemotions();
$article->demote($user2);
$end_nb_demo = $article->countDemotions();
$t->is($end_nb_promo, $init_nb_promo + 1, '::demote() add a demotion and ::countDemotions() works');

$article->demote($user2);
$one_time = $article->countDemotions();
$t->is($one_time, $end_nb_demo, '::demote() A user can demote an article only one time');

$init_nb_promo = $article->countPromotions();
$article->promote($user2);
$end_nb_promo = $article->countPromotions();
$t->is($init_nb_promo, $end_nb_promo, '::promote() A user cannot promote if he has already demoted');
?>