<?php
/**
 * HTML signin file
 *
 * @package piy
 * @subpackage sfZendOpenIdAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<section id="login">
  <section id="username-login">
    <h1><?php echo __('Username login') ?></h1>

    <form action="<?php echo url_for('@sf_openid_signin') ?>" method="POST">
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form->renderHiddenFields() ?>
      <table>
        <?php echo $form['username']->renderRow() ?>
        <?php echo $form['password']->renderRow() ?>
        <?php echo $form['remember']->renderRow() ?>
      </table>

      <input type="submit" value="<?php echo __('Sign in') ?>" />
      <?php echo link_to(__('Forgot your password?'), '@sf_guard_request_password') ?>
    </form>
  </section>

  <section id="openid-login">
    <h1><?php echo __('OpenID login') ?></h1>

    <form action="<?php echo url_for('@sf_openid_signin') ?>" method="POST">
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form->renderHiddenFields() ?>
      <table>
        <?php echo $form['openid_url']->renderRow() ?>
      </table>

      <input type="submit" value="<?php echo __('Sign in using OpenID') ?>" />
    </form>
  </section>

  <p><?php echo link_to(__('Create an account'), '@sf_guard_register') ?></p>
</section>