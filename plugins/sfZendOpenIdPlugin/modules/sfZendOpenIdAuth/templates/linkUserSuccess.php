<h1>Create an account with this OpenID</h1>

<h1>Bind this OpenID with an existing account</h1>

<form action="<?php echo url_for('@sf_openid_link_user') ?>" method="post">
  <table>
    <?php echo $linkUserForm ?>
  </table>

  <input type="submit" value="Link them!" />
</form>
