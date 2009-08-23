<?php
/**
 * HTML details file
 *
 * @package package
 * @subpackage subpackage
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Date', 'Number')
?>
  <section class="details">
    <?php if ($article->getCalendarDate()): ?>
      <section class="calendar">
	      <div class="dstart"><?php echo format_date($article->getCalendarDate()) ?></div>
	      <div class="location"><?php echo $article->getCalendarLocation() ?></div>
      </section>
	  <?php endif ?>

    <?php include_partial('article/tags', array('tags' => $article->getTags())) ?>

    <?php if (!$sf_params->get('username')): ?>
      <?php include_partial('article/authorHcard', array('article' => $article)) ?>
    <?php endif ?>
    
    <abbr class="updated" title="<?php echo date(DATE_ISO8601, strtotime($article->getUpdatedAt())); ?>">
      <?php echo __('Published %1% ago.', array('%1%' => time_ago_in_words(strtotime($article->getUpdatedAt()), true))) ?>
    </abbr>

    <ul class="stats">
      <li class="votes"><?php echo format_number_choice('[0]Be the first to rate this article.|[1]One vote.|(1,+Inf]%1% votes.', array('%1%' => format_number($article->countVotes())), $article->countVotes()) ?></li>
      <li class="comments"><?php echo format_number_choice('[0]Be the first to comment this article.|[1]One comment.|(1,+Inf]%1% comments.', array('%1%' => format_number($article->getNbComments())), $article->getNbComments()) ?></li>
    </ul>
  </section>