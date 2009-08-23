<?php
/**
 * Atom articles page
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title type="text"><?php echo __('%1%\'s articles', array('%1%' => $user)) ?></title>
  <subtitle><?php echo sfConfig::get('app_general_baseline') ?></subtitle>

  <link rel="alternate" type="text/html" hreflang="en" href="<?php echo url_for('@user_articles?username='.$user->getUsername(), true) ?>"/>
  <link rel="self" type="application/atom+xml" href="<?php echo url_for('@user_articles?username='.$user->getUsername().'&sf_format=atom', true) ?>"/>
  <?php include_partial('utils/generator') ?>

  <?php include_partial('article/list', array('article_pager' => $article_pager)) ?>
</feed>