<h1>Username login</h1>
<form action="<?php echo url_for('@sf_openid_signin') ?>" method="post">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  <table>
    <?php echo $form['username']->renderRow() ?>
    <?php echo $form['password']->renderRow() ?>
    <?php echo $form['remember']->renderRow() ?>
  </table>

  <input type="submit" value="sign in" />
</form>

<h1>OpenID login</h1>
<form action="<?php echo url_for('@sf_openid_signin') ?>" method="post">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  <table>
    <?php echo $form['openid_url']->renderRow() ?>
  </table>

  <input type="submit" value="sign in" />
</form>
