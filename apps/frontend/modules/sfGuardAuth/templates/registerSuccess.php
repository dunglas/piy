<h1><?php echo __('Create an account'); ?></h1>

<form action="<?php echo url_for('@sf_guard_register') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="<?php echo __('Create my account!') ?>" />
      </td>
    </tr>
  </table>
</form>