<?php
/**
 * Excerpt partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('XssSafe')
?>
<article id="article-<?php echo $article->getSlug() ?>" class="hentry">
  <h1 class="entry-title">
    <?php echo link_to($article->getTitle(), '@article_view?slug='.$article->getSlug(), array('rel' => 'bookmark')) ?>
  </h1>
  
  <div class="entry-content"><?php echo $article->getBody(ESC_XSSSAFE) ?></div>

  <?php include_partial('article/details', array('article' => $article)) ?>
</article>