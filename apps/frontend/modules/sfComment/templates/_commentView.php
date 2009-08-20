<?php use_helper('Date', 'XssSafe'); ?>

<div class="comment" id="comment_<?php echo $comment['Id'] ?>">
  <?php if (sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_use_gravatar', true)): ?>
    <?php if (!is_null($comment['AuthorId'])): ?>
      <?php
      include_component('sfComment',
                        'gravatar',
                        array('author_id'    => $comment['AuthorId'],
                              'sf_cache_key' => $comment['AuthorId']));
      ?>
    <?php else: ?>
      <?php
      include_component('sfComment',
                        'gravatar',
                        array('author_name'    => $comment['AuthorName'],
                              'author_email' => $comment['AuthorEmail'],
                              'sf_cache_key'   => $comment['AuthorEmail']));
      ?>
    <?php endif; ?>
  <?php endif; ?>
  <p class="comment_info">
    <?php
    if (!is_null($comment['AuthorId']))
    {
      $author = get_component('sfComment',
                              'author',
                              array('author_id'    => $comment['AuthorId'],
                                    'sf_cache_key' => $comment['AuthorId']));
    }
    else
    {
      $author = get_component('sfComment',
                              'author',
                              array('author_name'    => $comment['AuthorName'],
                                    'author_website' => $comment['AuthorWebsite']));
    }

    $date_format = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_date_format', 'words');
    if ('words' == $date_format)
    {
      $date = __('%1% ago', array('%1%' => distance_of_time_in_words(strtotime($comment['CreatedAt']))));
    }
    else
    {
      $date = format_date(strtotime($comment['CreatedAt']), $date_format);
    }
    ?>
    <?php
    echo __('<span class="comment_author">%1%</span>, <a href="#comment_%2%">%3%</a>',
            array('%1%' => $author,
                  '%2%' => $comment['Id'],
                  '%3%' => $date))
    ?>
  </p>
  <div class="comment_text">
    <?php $safe = $sf_data->get('comment', ESC_XSSSAFE) ?>
    <?php echo $safe['Text']; ?>
  </div>
</div>