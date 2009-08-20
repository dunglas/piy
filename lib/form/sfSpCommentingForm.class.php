<?php
class sfSpCommentingForm extends sfCommentingForm {
	public function configure() {
    $this->widgetSchema['text'] = new sfWidgetFormTextareaTinyMCE(array(
      'width'  => 350,
      'height' => 250,
      'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
      ),
      array('class' => 'sf_comment_text')
    );
    
    $this->widgetSchema->moveField('text', sfWidgetFormSchema::LAST);
    
    if (isset($this->widgetSchema['title']))
      $this->widgetSchema->moveField('title', sfWidgetFormSchema::FIRST);
    
    if (!sfContext::getInstance()->getUser()->isAuthenticated()) {
	    $this->widgetSchema['captcha'] = new sfAnotherWidgetFormReCaptcha();
	    $this->validatorSchema->setPostValidator(
	      new sfAnotherValidatorSchemaReCaptcha($this, 'captcha')
	    );
    }
	}
}