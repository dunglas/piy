<?php
/**
 * HTML hcard
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<section class="vcard">
  <?php echo gravatar_image_tag($user->getProfile()->getEmail(), null, null, $user) ?>
  <?php echo link_to($user, '@user_articles?username='.$user->getUsername(), array('class' => 'fn nickname url')) ?>
</section>