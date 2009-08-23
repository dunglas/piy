<?php
/**
 * HTML user comments sidebar
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Gravatar')
?>
<section class="user" id="user-<?php echo $user->getUsername() ?>">
  <?php include_partial('user/hcard', array('user' => $user)) ?>

  <?php include_component('user', 'articles') ?>
</section>