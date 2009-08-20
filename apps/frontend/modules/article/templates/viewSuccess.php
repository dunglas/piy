<?php use_helper('Date', 'Number', 'XssSafe') ?>

<div class="hentry<?php if ($article->getCalendarDate ()): ?> vevent<?php endif ?>">
	<h1 class="entry-title"><?php echo $article->getTitle() ?></h1>
	  
	<div class="entry-content<?php if ($article->getCalendarDate ()): ?> summary<?php endif ?>">
	  <?php echo $article->getBody(ESC_XSSSAFE) ?>
	</div>
	
	<?php if ($article->getCalendarDate ()): ?>
	  <div class="dstart"><?php echo format_date($article->getCalendarDate()) ?></div>
	  <div class="location"><?php echo $article->getCalendarLocation() ?></div>
	<?php endif ?>
	  
	<?php if ($article->getUserId()): ?>
	  <?php $author = $article->getsfGuardUser()->__toString() ?>
	<?php else: ?>
	  <?php $author = $article->getAuthor() ?>
	<?php endif ?>
	
	<abbr class="published" title="<?php echo date(DATE_ISO8601, strtotime($article->getCreatedAt())); ?>"><?php echo __('Published by <span class="vcard"><span class="fn nickname">%2%</span></span> %1% ago', array('%1%' => time_ago_in_words(strtotime($article->getCreatedAt()), true), '%2%' => $author)) ?></abbr>
	<?php if ($article->getUpdatedAt() != $article->getCreatedAt()): ?>
	<abbr class="updated" title="<?php echo date(DATE_ISO8601, strtotime($article->getUpdatedAt())); ?>"><?php echo __('Updated %1% ago', array('%1%' => time_ago_in_words(strtotime($article->getUpdatedAt()), true))) ?></abbr>
	<?php endif ?>
	
	<div id="tags">
	<?php foreach ($article->getTags() as $tag): ?>
    <?php echo link_to($tag, '@homepage', array('rel' => 'tag')) ?>
  <?php endforeach ?>
	</div>
	
	<div id="vote">
	  <h2><?php echo __('Promotion') ?></h2>
	  <p><?php echo format_number_choice('[0]This article has not been promoted.|[1]This article has been promoted one time.|(1,+Inf]This article has been demoted %1% times.', array('%1%' => format_number($article->countVotes())), $article->countVotes()) ?>
		<?php if ($sf_user->isAuthenticated()): ?>
		  <?php if ($vote = $sf_user->getGuardUser()->getVoteFor($article->getRawValue())): ?>
		    <p><?php echo __('You have promoted this article.') ?></p>		  
		    <p><?php echo link_to(__('Remove your vote'), '@article_unvote?slug='.$article->getSlug()) ?></p>
	  <?php else: ?>
	      <p><?php echo link_to(__('Promote'), '@article_vote?slug='.$article->getSlug()) ?></p>
		<?php endif ?>
		  
		<?php else: ?>
		  <p><?php echo __('Signin or <a href="%1%">register</a> to promote or demote this article.', array('%1%' => '@sf_guard_register')) ?></p>
		<?php endif ?>
	</div>
	
	<?php
	include_component('sfComment', 'commentList', array('object' => $article));
	include_component('sfComment', 'commentForm', array('object' => $article));
	?>
</div>