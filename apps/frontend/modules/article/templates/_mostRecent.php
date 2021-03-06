<?php
/**
 * Most recent articles partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
?>
<section id="most-recent-articles">
  <h1><?php echo __('Most recent articles') ?></h1>

	<?php include_partial('article/titlesList', array('articles' => $article_pager->getResults())) ?>

  <p><?php echo link_to(__('More...'), 'article_most_recent') ?></p>
</section>