<?php
/**
 * Atom view page
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('XssSafe');

echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title type="text"><?php echo __('%1% and comments', array('%1%' => $article->getTitle())) ?></title>

  <link rel="alternate" type="text/html" hreflang="en" href="<?php echo url_for('@article_view?slug='.$article->getSlug(), true) ?>"/>
  <link rel="self" type="application/atom+xml" href="<?php echo url_for('@article_view?slug='.$article->getSlug().'&sf_format=atom', true) ?>"/>
  <?php include_partial('utils/generator') ?>

  <?php include_partial('article/entry', array('article' => $article)) ?>
  <?php include_component('sfComment', 'commentList', array('object' => $article)) ?>
</feed>