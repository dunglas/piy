<form action="<?php echo url_for('@sf_guard_signin') ?>" method="POST">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="<?php echo __('Sign in') ?>" />
  <?php echo link_to(__('Forgot your password?'), '@sf_guard_password') ?>
</form>

<?php echo link_to(__('Create an account'), '@sf_guard_register') ?>