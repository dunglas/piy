<?php
/**
 * HTML user articles sidebar
 *
 * @package piy
 * @subpackage sidebar
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Gravatar')
?>
<section class="user" id="user-<?php echo $user->getUsername() ?>">
  <?php include_partial('user/hcard', array('user' => $user)) ?>

  <?php include_component('user', 'comments') ?>
</section>