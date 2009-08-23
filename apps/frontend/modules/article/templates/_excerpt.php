<?php
/**
 * Excerpt partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Number', 'XssSafe')
?>
<article id="article-<?php echo $article->getSlug() ?>">
  <h1 class="entry-title">
    <?php echo link_to($article->getTitle(), '@article_view?slug='.$article->getSlug(), array('rel' => 'bookmark')) ?>
  </h1>
  
  <div class="entry-content"><?php echo $article->getBody(ESC_XSSSAFE) ?></div>

  <?php include_partial('article/tags', array('tags' => $article->getTags())) ?>
  <span class="vcard"><span class="fn nickname"><?php echo $article->getAuthor() ?></span></span>, <abbr class="updated" title="<?php echo date(DATE_ISO8601, strtotime($article->getUpdatedAt())); ?>"><?php echo __('%1% ago', array('%1%' => time_ago_in_words(strtotime($article->getUpdatedAt()), true))) ?></abbr>
  <p class="votes"><?php echo format_number_choice('[0]No votes.|[1]One vote.|(1,+Inf]%1% votes.', array('%1%' => format_number($article->countVotes())), $article->countVotes()) ?></p>
</article>