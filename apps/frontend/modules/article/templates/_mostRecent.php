<?php
/**
 * Most recent articles partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
?>
<div id="most-recent">
  <h3><?php echo __('Most recent articles') ?></h3>

	<ul>
	<?php foreach ($article_pager->getResults() as $article): ?>
	  <li><?php echo link_to($article, '@article_view?slug='.$article->getSlug()) ?></li>
	<?php endforeach ?>
	</ul>

  <p><?php echo link_to(__('More...'), 'article_most_recent') ?></p>
</div>