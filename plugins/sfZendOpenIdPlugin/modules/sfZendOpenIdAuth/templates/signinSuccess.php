<form action="<?php echo url_for('@sf_zend_openid_signin') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="sign in" />
</form>
