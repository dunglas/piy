<?php
/**
 * Check if the email is associated with an user
 *
 * @package piy
 * @subpackage lib.form
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class sfGuardUserProfileEmailForm extends sfForm {
  /**
   * Configures the form
   */
  public function configure() {
    $this->setWidgets(array(
      'email' => new sfWidgetFormInput()
    ));

    $this->setValidators(array(
      'email' => new sfValidatorAnd(array(
        new sfValidatorPropelChoice(array('model' => 'SfGuardUserProfile', 'column' => 'email', 'required' => true)),
        new sfValidatorEmail()
      ))
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_email[%s]');
  }
}