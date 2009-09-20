<?php

class sfOpenIdLinkUserForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormInput(),
      'password' => new sfWidgetFormInput(array('type' => 'password')),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorString(),
      'password' => new sfValidatorString(),
    ));

    $this->validatorSchema->setPostValidator(new sfOpenIdLinkUserValidator());

    $this->widgetSchema->setNameFormat('link_user[%s]');
  }
}
