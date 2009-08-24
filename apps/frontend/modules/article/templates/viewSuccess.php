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
  <link rel="alternate" type="application/atom+xml" title="<?php echo __('%1% and comments', array('%1%' => $article->getTitle())) ?>" href="<?php echo url_for('@article_view?slug='.$article->getSlug().'&sf_format=atom', true) ?>" />
<?php end_slot() ?>

<article class="hentry<?php /*if ($article->getDate ()): ?> vevent<?php endif*/ ?>">
	<h1 class="entry-title"><?php echo $article->getTitle() ?></h1>
	  
	<div class="entry-content<?php /*if ($article->getDate ()): ?> summary<?php endif*/ ?>">
	  <?php echo $article->getBody(ESC_XSSSAFE) ?>
	</div>
	
	<?php include_partial('article/details', array('article' => $article)) ?>

	<section id="vote">
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