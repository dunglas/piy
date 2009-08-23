<?php
/**
 * Most recent articles partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
?>
<section class="articles">
  <h1><?php echo __('%1%\'s articles', array('%1%' => $user)) ?></h1>

	<ul>
    <?php foreach ($articles_pager->getResults() as $article): ?>
      <li><?php echo link_to($article, '@article_view?slug='.$article->getSlug()) ?></li>
	  <?php endforeach ?>
  </ul>

  <p><?php echo link_to(__('More...'), '@user_articles?username='.$user->getUsername()) ?></p>
</section>