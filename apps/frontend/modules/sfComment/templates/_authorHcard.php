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
<div class="vcard">
  <?php if ($guardUser): ?>
    <?php echo gravatar_image_tag($guardUser->getProfile()->getEmail(), null, null, $guardUser) ?>
    <?php echo link_to($guardUser, '@user_articles?username='.$guardUser->getUsername(), array('class' => 'fn nickname url')) ?>
  <?php else: ?>
  <?php echo $comment['AuthorWebsite'] ? link_to($comment['AuthorName'], $comment['AuthorWebsite'], array('class' => 'url fn nickname')) : '<span class="fn nickname">'.$comment['AuthorName'].'</span>' ?>
<?php endif ?>
</div>