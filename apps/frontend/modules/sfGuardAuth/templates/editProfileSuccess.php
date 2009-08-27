<?php
/**
 * HTML edit profile file
 *
 * @package piy
 * @subpackage sfGuardAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<h1><?php echo __('Edit your profile'); ?></h1>

<p><?php echo link_to(__('Change your password'), '@sf_guard_change_password') ?></p>

<form action="<?php echo url_for('@sf_guard_edit_profile') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="<?php echo __('Modify your profile!') ?>" />
      </td>
    </tr>
  </table>
</form>