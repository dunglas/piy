<?php

/**
 * Article form.
 *
 * @package    selfpublish
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ArticleForm extends BaseArticleForm
{
  public function configure()
  {  	
  	unset(
  	  $this['slug'],
  	  $this['user_id'],
  	  $this['is_active'],
  	  $this['created_at'],
  	  $this['updated_at'],
  	  $this['sf_comment_count']
  	);
  	
  	$this->widgetSchema['tags'] = new sfWidgetFormInput();
    $this->validatorSchema['tags'] = new sfValidatorString();
  	
  	if ($this->getOption('user')) unset($this['author']);
  	else {
  		$this->widgetSchema['captcha'] = new sfAnotherWidgetFormReCaptcha();
	    $this->validatorSchema->setPostValidator(
	      new sfAnotherValidatorSchemaReCaptcha($this, 'captcha')
	    );
  	}
  	
  	$this->widgetSchema['body'] = new sfWidgetFormTextareaTinyMCE(array(
      'width'  => 550,
      'height' => 350,
      'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
      ),
      array('class' => 'article_body')
    );    
  }
  
  public function updateObject($values = null) {
  	$object = parent::updateObject($values);
  	
  	$object->addTag($this->getValue('tags'));
  	
  	if ($this->getOption('user')) {
  		$object->setUserId($this->getOption('user')->getId());
  	}
  	
  	return $object;
  }
}