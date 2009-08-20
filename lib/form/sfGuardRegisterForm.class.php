<?php
class sfGuardRegisterForm extends sfGuardUserForm
{
  public function configure()
  {
  	parent::configure();

    unset(
      $this['first_name'],
      $this['last_name'],
      $this['birth_date'],
      $this['location'],
      $this['latitude'],
      $this['longitude'],
      $this['bio'],
      $this['jabber'],
      $this['live'],
      $this['aim'],
      $this['twitter'],
      $this['homepage'],
      $this['rss'],
      $this['phone']
    );
    
    $this->validatorSchema['password'] = new sfValidatorString(
      array('min_length' => 6, 'max_length' => 128)
    );
    
    $this->widgetSchema['captcha'] = new sfAnotherWidgetFormReCaptcha();
    $this->mergePostValidator(
      new sfAnotherValidatorSchemaReCaptcha($this, 'captcha')
    );
  }
}