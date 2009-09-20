<h1><?php echo __('Link this OpenID with an existing account') ?></h1>
<form action="<?php echo url_for('@sf_openid_link_user') ?>" method="post">
  <table>
    <?php echo $linkUserForm ?>
  </table>

  <input type="submit" value="<?php echo __('Link them!') ?>" />
</form>
