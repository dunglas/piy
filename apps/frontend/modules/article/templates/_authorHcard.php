<?php
/**
 * HTML vcard
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Gravatar')
?>
<section class="vcard">
  <?php if ($article->getUserId()): ?>
    <?php echo gravatar_image_tag($article->getsfGuardUser()->getProfile()->getEmail(), null, null, $article->getAuthor()) ?>
    <?php echo link_to($article->getAuthor(), '@user_articles?username='.$article->getsfGuardUser()->getUsername(), array('class' => 'fn nickname url')) ?>
  <?php else: ?>
  <span class="fn nickname"><?php echo $article->getAuthor() ?></span>
<?php endif ?>
</section>