<?php
/**
 * HTML recover password file
 *
 * @package piy
 * @subpackage sfGuardAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<h1><?php echo __('Change your password'); ?></h1>

<form action="<?php echo url_for('@sf_guard_change_password') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="<?php echo __('Change my password!') ?>" />
      </td>
    </tr>
  </table>
</form>