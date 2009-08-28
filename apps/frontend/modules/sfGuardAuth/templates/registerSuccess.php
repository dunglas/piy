<?php
/**
 * HTML register file
 *
 * @package piy
 * @subpackage sfGuardAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

function display_form($form) {
  foreach($form as $field) {
    if (get_class($field) == 'sfFormFieldSchema') {
      display_form($field);
    } elseif (!$field->isHidden()) {
      echo $field->renderRow();
    }
  }
}
?>
<h1><?php echo __('Create an account'); ?></h1>

<form action="<?php echo url_for('@sf_guard_register') ?>" method="POST">
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
  <table>
    <?php display_form($form) ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="<?php echo __('Create my account!') ?>" />
      </td>
    </tr>
  </table>
</form>