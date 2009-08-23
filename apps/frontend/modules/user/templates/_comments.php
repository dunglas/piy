<?php
/**
 * HTML comments title list
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<section class="comments">
  <h1><?php echo __('%1%\'s comments', array('%1%' => $user)) ?></h1>

  <ul>
    <?php foreach ($comments_pager->getResults() as $comment): ?>
      <li><?php echo link_to($comment, '@article_view?slug='.$comment->getCommentable()->getSlug().'#comment_'.$comment->getId()) ?></li>
	  <?php endforeach ?>
  </ul>

  <p><?php echo link_to(__('More...'), '@user_comments?username='.$user->getUsername()) ?></p>
</section>