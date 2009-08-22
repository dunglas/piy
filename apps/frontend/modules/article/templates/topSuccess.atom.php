<?php
/**
 * Atom top page
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title type="text"><?php echo __('Most rated articles of %1% %2%', array('%1%' => sfConfig::get('app_general_name'), '%2%' => $sf_params->get('time') == 'ever' ? __('ever') : __('for '.str_replace('-', ' ', $sf_params->get('time'))))) ?></title>
  <subtitle><?php echo sfConfig::get('app_general_baseline') ?></subtitle>

  <link rel="alternate" type="text/html" hreflang="en" href="<?php echo url_for('@article_top?time='.$sf_params->get('time'), true) ?>"/>
  <link rel="self" type="application/atom+xml" href="<?php echo url_for('@article_top?time='.$sf_params->get('time').'&sf_format=atom', true) ?>"/>
  <?php include_partial('utils/generator') ?>

  <?php include_partial('article/list', array('article_pager' => $article_pager)) ?>
</feed>