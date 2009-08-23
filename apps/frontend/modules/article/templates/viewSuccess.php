<?php
/**
 * HTML view page
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Date', 'Number', 'XssSafe')
?>

<?php slot('atom') ?>
  <link rel="alternate" type="application/atom+xml" title="<?php echo __('"%1%" and comments', array('%1%' => $article->getTitle())) ?>" href="<?php echo url_for('@article_view?slug='.$article->getSlug().'&sf_format=atom', true) ?>" />
<?php end_slot() ?>

<article class="hentry<?php if ($article->getCalendarDate ()): ?> vevent<?php endif ?>">
	<h1 class="entry-title"><?php echo $article->getTitle() ?></h1>
	  
	<div class="entry-content<?php if ($article->getCalendarDate ()): ?> summary<?php endif ?>">
	  <?php echo $article->getBody(ESC_XSSSAFE) ?>
	</div>
	
	<?php if ($article->getCalendarDate ()): ?>
	  <div class="dstart"><?php echo format_date($article->getCalendarDate()) ?></div>
	  <div class="location"><?php echo $article->getCalendarLocation() ?></div>
	<?php endif ?>
	
	<abbr class="published" title="<?php echo date(DATE_ISO8601, strtotime($article->getCreatedAt())); ?>"><?php echo __('Published by %1% %2% ago', array('%1%' => '<span class="vcard"><span class="fn nickname">'.$article->getAuthor().'</span></span>', '%2%' => time_ago_in_words(strtotime($article->getCreatedAt()), true))) ?></abbr>
	<?php if ($article->getUpdatedAt() != $article->getCreatedAt()): ?>
	<abbr class="updated" title="<?php echo date(DATE_ISO8601, strtotime($article->getUpdatedAt())); ?>"><?php echo __('Updated %1% ago', array('%1%' => time_ago_in_words(strtotime($article->getUpdatedAt()), true))) ?></abbr>
	<?php endif ?>

  <?php include_partial('article/tags', array('tags' => $article->getTags())) ?>
	
	<section id="vote">
	  <p class="votes"><?php echo format_number_choice('[0]No votes.|[1]One vote.|(1,+Inf]%1% votes.', array('%1%' => format_number($article->countVotes())), $article->countVotes()) ?>

    <?php if ($sf_user->isAuthenticated()): ?>
		  <?php if ($vote = $sf_user->getGuardUser()->getVoteFor($article->getRawValue())): ?>
		    <p><?php echo __('You voted this article.') ?></p>
		    <p><?php echo link_to(__('Remove your vote'), '@article_unvote?slug='.$article->getSlug()) ?></p>
	  <?php else: ?>
	      <p><?php echo link_to(__('Vote'), '@article_vote?slug='.$article->getSlug()) ?></p>
		<?php endif ?>
		  
		<?php else: ?>
		  <p><?php echo __('Signin or <a href="%1%">register</a> to rate this article.', array('%1%' => url_for('@sf_guard_register'))) ?></p>
		<?php endif ?>
	</section>
	
	<?php	include_component('sfComment', 'commentList', array('object' => $article)) ?>
	<?php include_component('sfComment', 'commentForm', array('object' => $article)) ?>
</article>