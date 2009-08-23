<?php
/**
 * HTML comments list
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Date', 'XssSafe')
?>
<?php slot('atom') ?>
  <link rel="alternate" type="application/atom+xml" title="<?php echo __('%1%\'s comments', array('%1%' => $user)) ?>" href="<?php echo url_for('@user_comments?username='.$user->getUsername().'&sf_format=atom', true) ?>" />
<?php end_slot() ?>

<h1><?php echo __('%1%\'s comments', array('%1%' => $user)) ?></h1>

<?php if ($comments_pager->getNbResults()): ?>
	<section class="hfeed">
	<?php foreach ($comments_pager->getResults() as $comment): ?>
	  <article id="comment-<?php echo $comment->getId() ?>" class="hentry">
      <h1 class="entry-title">
      <?php echo link_to($comment->getTitle(), '@article_view?slug='.$comment->getCommentable()->getSlug().'#comment_'.$comment->getId(), array('rel' => 'bookmark')) ?>
      </h1>

      <div class="entry-content"><?php echo $comment->getText(ESC_XSSSAFE) ?></div>

      <abbr class="updated" title="<?php echo date(DATE_ISO8601, strtotime($comment->getCreatedAt())); ?>">
        <?php echo __('Published %1% ago.', array('%1%' => time_ago_in_words(strtotime($comment->getCreatedAt()), true))) ?>
      </abbr>
    </article>
	<?php endforeach; ?>

	<?php include_component('utils', 'pager', array('pager' => $comments_pager)) ?>
	</section>
<?php else: ?>
	<p><?php echo __('No comment match your selection.'); ?></p>
<?php endif ?>