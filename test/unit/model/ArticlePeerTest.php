<?php
require_once dirname(__FILE__).'/../../bootstrap/propel.php';
$t = new lime_test(2, new lime_output_color());

$slug = 'welcome-to-self-publish';
$article = ArticlePeer::retrieveBySlug($slug);
$t->is($article->getSlug(), $slug, '::retrieveBySlug() return the correct Article');

$article = ArticlePeer::retrieveBySlug(Utils::generateHash());
$t->is($article, false, '::retrieveBySlug() return false if the Article does no exist');
?>