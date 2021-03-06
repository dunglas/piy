<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    selfpublish
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class sfGuardUserProfileForm extends BaseSfGuardUserProfileForm
{
  public function configure()
  {
    unset(
      $this['user_id'],
      $this['hash'],
      $this['hash_created_at']
    );

    $this->mergePostValidator(
      new sfValidatorPropelUnique(array('model' => 'SfGuardUserProfile', 'column' => array('email')))
    );
  }
}
