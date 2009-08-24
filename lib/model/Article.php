<?php

class Article extends BaseArticle
{
	/**
	 * Article title.
	 * 
	 * @return String
	 */
	public function __toString() {
		return $this->getTitle();
	}

  public function getAuthor() {
    if ($this->getsfGuardUser())
      return $this->getsfGuardUser()->__toString();

    if (parent::getAuthor())
      return parent::getAuthor();

    return sfContext::getInstance()->getI18N()->__('Anonymous');
  }

  /**
   * Is this article dated ?
   *
   * @return boolean
   */
  public function isDated() {
    return false;
  }

  /**
   * Is this article located ?
   *
   * @return boolean
   */
  public function isLocated() {
    return false;
  }
}

$columns_map = array('from'   => ArticlePeer::TITLE,
  'to'     => ArticlePeer::SLUG);
 
sfPropelBehavior::add('Article', array('sfPropelActAsSluggableBehavior' =>
  array('columns' => $columns_map, 'separator' => '-', 'permanent' => true)));
sfPropelBehavior::add('Article', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Article', array('sfPropelActAsTaggableBehavior'));