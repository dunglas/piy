<?php

class sfZendOpenIdFormSignin extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormInput(),
      'password' => new sfWidgetFormInput(array('type' => 'password')),
      'remember' => new sfWidgetFormInputCheckbox(),
      'openid_url'=> new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorString(array('required' => false)),
      'password' => new sfValidatorString(array('required' => false)),
      'remember' => new sfValidatorBoolean(array('required' => false)),
      'openid_url' => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(new sfZendOpenIdValidatorIdentifier());

    $this->widgetSchema->setNameFormat('signin[%s]');
  }
}
