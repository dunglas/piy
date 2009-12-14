<?php use_helper('Date', 'XssSafe'); ?>

<div class="comment" id="comment_<?php echo $comment['Id'] ?>">
  <h2 class="entry-title"><?php echo $comment['Title'] ?></h2>

  <div class="comment_text entry_content">
    <?php $safe = $sf_data->get('comment', ESC_XSSSAFE) ?>
    <?php echo $safe['Text']; ?>
  </div>

  <?php include_component('sfComment', 'authorHcard', array('comment' => $comment)) ?>
  <abbr class="updated" title="<?php echo date(DATE_ISO8601, strtotime($comment['CreatedAt'])); ?>">
      <?php echo __('Published %1% ago.', array('%1%' => time_ago_in_words(strtotime($comment['CreatedAt']), true))) ?>
  </abbr>
</div>