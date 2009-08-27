<?php
/**
 * HTML password retrieving file
 *
 * @package piy
 * @subpackage sfGuardAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<h1><?php echo __('Retrieve your password'); ?></h1>

<form action="<?php echo url_for('@sf_guard_password') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="<?php echo __('Retrieve my password!') ?>" />
      </td>
    </tr>
  </table>
</form>