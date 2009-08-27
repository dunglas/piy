<?php
class sfGuardRegisterForm extends sfGuardUserForm
{
  public function configure()
  {
  	parent::configure();

    
    $this->validatorSchema['password'] = new sfValidatorString(
      array('min_length' => 6, 'max_length' => 128)
    );

    $this->validatorSchema['email'] = new sfValidatorAnd(
      array(
        $this->validatorSchema['email'],
        new sfPropelUniqueValidator(array('class' => 'SfGuardUserProfile', 'column' => 'email'))
      )
    );
    
    $this->widgetSchema['captcha'] = new sfAnotherWidgetFormReCaptcha();
    $this->mergePostValidator(
      new sfAnotherValidatorSchemaReCaptcha($this, 'captcha')
    );
  }
}