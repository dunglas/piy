<?php
/**
 * HTML titles list partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<ul>
  <?php foreach ($articles as $article): ?>
    <li><?php echo link_to($article, '@article_view?slug='.$article->getSlug()) ?></li>
	<?php endforeach ?>
</ul>