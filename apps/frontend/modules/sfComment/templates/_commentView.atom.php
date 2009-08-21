<?php
/**
 * Atom comment entry tag
 *
 * @package piy
 * @subpackage sfComment
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<entry>
    <title><?php echo __('Comment #%1%', array('%1%' => $number)) ?></title>
    <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', strtotime($comment['CreatedAt'])) ?></updated>

    <?php if ($comment['AuthorId']): ?>
      <?php include_component(
        'sfComment',
        'author',
        array('author_id' => $comment['AuthorId'], 'sf_cache_key' => $comment['AuthorId'])
      )
      ?>
    <?php else: ?>
    <?php
    include_component(
      'sfComment',
      'author',
      array('author_name' => $comment['AuthorName'], 'author_website' => $comment['AuthorWebsite'])
    );
    ?>
    <?php endif ?>

    <content type="xhtml">
      <div xmlns="http://www.w3.org/1999/xhtml">
        <?php $safe = $sf_data->get('comment', ESC_XSSSAFE) ?>
        <?php echo $safe['Text']; ?>
      </div>
    </content>
  </entry>