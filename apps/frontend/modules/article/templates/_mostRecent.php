<div id="most-recent">
  <h3><?php echo __('Most recent articles') ?></h3>

	<ul>
	<?php foreach ($article_pager->getResults() as $article): ?>
	  <li><?php echo link_to($article, '@article_view?slug='.$article->getSlug()) ?></li>
	<?php endforeach ?>
	</ul>
</div>