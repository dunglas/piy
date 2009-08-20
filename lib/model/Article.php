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
}

$columns_map = array('from'   => ArticlePeer::TITLE,
  'to'     => ArticlePeer::SLUG);
 
sfPropelBehavior::add('Article', array('sfPropelActAsSluggableBehavior' =>
  array('columns' => $columns_map, 'separator' => '-', 'permanent' => true)));
sfPropelBehavior::add('Article', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Article', array('sfPropelActAsTaggableBehavior'));