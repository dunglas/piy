<form action="<?php echo url_for('@sf_guard_signin') ?>" method="POST">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="<?php echo __('Sign in') ?>" />
  <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __('Forgot your password?') ?></a>
</form>

<?php echo link_to(__('Create an account'), '@sf_guard_register') ?>