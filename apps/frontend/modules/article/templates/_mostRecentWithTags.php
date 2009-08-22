<?php
/**
 * HTML partial for most recent articles with some tags
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<section class="tags-most-recent-articles" id="<?php echo $sf_params->get('tags') ?>-most-recent-articles">
  <h1><?php echo __('%1% most recent articles', array('%1%' => $sf_params->get('tags'))) ?></h1>

	<?php include_partial('article/titlesList', array('articles' => $article_pager->getResults())) ?>

  <p><?php echo link_to(__('More...'), 'article_most_recent') ?></p>
</section>