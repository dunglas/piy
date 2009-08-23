<?php
/**
 * Atom comments page
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('XssSafe');

echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title type="text"><?php echo __('%1%\'s comments', array('%1%' => $user)) ?></title>
  <subtitle><?php echo sfConfig::get('app_general_baseline') ?></subtitle>

  <link rel="alternate" type="text/html" hreflang="en" href="<?php echo url_for('@user_comments?username='.$user->getUsername(), true) ?>"/>
  <link rel="self" type="application/atom+xml" href="<?php echo url_for('@user_comments?username='.$user->getUsername().'&sf_format=atom', true) ?>"/>
  <?php include_partial('utils/generator') ?>

  <?php foreach ($comments_pager->getResults() as $comment): ?>
	<entry>
    <title><?php echo $comment->getTitle() ?></title>
    <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', strtotime($comment->getCreatedAt())) ?></updated>
    <link rel="alternate" type="text/html" href="<?php echo url_for('@article_view?slug='.$comment->getCommentable()->getSlug(), true) ?>#comment_<?php echo $comment->getId() ?>"/>

    <author>
      <name><?php echo $user ?></name>
    </author>

    <content type="xhtml">
      <div xmlns="http://www.w3.org/1999/xhtml">
        <?php echo $comment->getText(ESC_XSSSAFE) ?>
      </div>
    </content>
  </entry>
	<?php endforeach; ?>
</feed>