<?php
/**
 * Password email
 *
 * @package piy
 * @subpackage sfGuardAuth
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<?php echo __('Your login is %1%.', array('%1%' => $user->getUsername())) ?>

<?php echo __('Click on the following link to set a new password to your account: %1%', array('%1%' => url_for('@sf_guard_change_password?hash='.$hash, true))) ?>

--
<?php echo sfConfig::get('app_email_name') ?>