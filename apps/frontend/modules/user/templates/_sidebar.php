<?php
/**
 * HTML user sidebar
 *
 * @package piy
 * @subpackage sidebar
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Gravatar')
?>
<section class="user" id="user-<?php echo $sf_params->get('username') ?>">
  <?php echo gravatar_image_tag($user->getProfile()->getEmail(), null, null, $user->__toString()) ?>

  <?php include_component('user', 'comments') ?>
</section>