<?php
/**
 * HTML change password file
 *
 * @package piy
 * @subpackage sfGuardAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<h1><?php echo __('Change your password'); ?></h1>

<p><?php echo __('You are changing the password associated with the username %1%.', array('%1%' => '<strong>'.$user.'</strong>')) ?></p>

<form action="<?php echo url_for('@sf_guard_change_password?hash='.$sf_params->get('hash')) ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="<?php echo __('Change my password!') ?>" />
      </td>
    </tr>
  </table>
</form>