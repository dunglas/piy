<?php

class sfZendOpenIdFormSignin extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'openid_url'=> new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'openid_url' => new sfValidatorString(),
    ));

    $this->validatorSchema->setPostValidator(new sfZendOpenIdValidatorIdentifier());

    $this->widgetSchema->setNameFormat('signin[%s]');
  }
}
