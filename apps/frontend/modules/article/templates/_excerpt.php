<?php use_helper('XssSafe') ?>

<h2 class="entry-title"><?php echo link_to($article->getTitle(), '@article_view?slug='.$article->getSlug(), array('rel' => 'bookmark')) ?></h2>
  
<div class="entry-content"><?php echo $article->getBody(ESC_XSSSAFE) ?></div>
  
<?php if ($article->getUserId()): ?>
  <?php $author = $article->getsfGuardUser()->__toString() ?>
<?php else: ?>
  <?php $author = $article->getAuthor() ?>
<?php endif ?>
  
<span class="vcard"><span class="fn nickname"><?php echo $author ?></span></span>, <abbr class="updated" title="<?php echo date(DATE_ISO8601, strtotime($article->getUpdatedAt())); ?>"><?php echo __('%1% ago', array('%1%' => time_ago_in_words(strtotime($article->getUpdatedAt()), true))) ?></abbr>