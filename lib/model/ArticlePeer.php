<?php

class ArticlePeer extends BaseArticlePeer
{
	/**
	 * Create a Propel pager
	 * 
	 * @param Criteria $criteria
	 * @param int $page
	 * @param int $nb
	 * @return sfPropelPager
	 */
	private static function getPager($criteria, $page = 1, $nb = 10) {
		$pager = new sfPropelPager('Article', $nb);
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();
		
    return $pager;
	}
	
	/**
	 * Retrieve an article by its slug
	 *
	 * @param string $slug
	 * @param boolean $active
	 * @return Article
	 */
	public static function retrieveBySlug($slug, $active = true) {
		$c = new Criteria();
		$c->add(self::SLUG, $slug);
		if (!is_null($active)) $c->add(self::IS_ACTIVE, $active);
		
		return self::doSelectOne($c);
	}
	
	/**
	 * Create a Criteria to select the most recent articles
	 * 
	 * @param Criteria $criteria
	 * @param mixed $active Boolean or null for both
	 * @return Criteria
	 */
	protected static function getMostRecentCriteria($active = true, $criteria = null) {
		if (is_null($criteria)) $criteria = new Criteria();
	  if (!is_null($active)) $criteria->add(self::IS_ACTIVE, $active);
		$criteria->addDescendingOrderByColumn(self::CREATED_AT);
		
		return $criteria;
	}
	
	/**
	 * Get a pager of the most recent articles
	 * 
	 * @param int $page
	 * @param int $nb
	 * @param mixed $active Boolean or null for both
	 * @return sfPropelPager
	 */
	public static function getMostRecent($page = 1, $nb = 10, $active = true) {
    return self::getPager(self::getMostRecentCriteria($active), $page, $nb);
	}
	
	/**
	 * Get a pager of the most recent articles tagger with the supplyed tags
	 * 
	 * @param string $tags
	 * @param int $page
	 * @param int $nb
	 * @param mixed $active Boolean or null for both
	 * @return sfPropelPager
	 */
	public static function getMostRecentTaggedWith($tags, $page = 1, $nb = 10, $active = true, $options = array()) {
		$criteria = TagPeer::getTaggedWithCriteria('Article', $tags, null, $options);
		$criteria = self::getMostRecentCriteria($active, $criteria);
		
		return self::getPager($criteria, $page, $nb);
	}
	
	/**
	 * Create a Criteria to select the most voted articles
	 * 
	 * @param string $start A valid strtotime() parameter
	 * @param string $end A valid strtotime() parameter
	 * @param mixed $active Boolean or null for both
	 * @param Criteria $criteria
	 * @return Criteria
	 */
	protected static function getMostVotedCriteria($start = null, $end = null, $active = true, $criteria = null) {
		if (is_null($criteria)) $criteria = new Criteria();
		
		if (!is_null($active)) $criteria->add(self::IS_ACTIVE, $active);
    if (!is_null($start) && !is_null($end)) {
      $criterion = $criteria->getNewCriterion(self::CREATED_AT, $start, Criteria::GREATER_EQUAL);
      $criterion->addAnd($criteria->getNewCriterion(self::CREATED_AT, $end, Criteria::LESS_EQUAL));
      $criteria->add($criterion);
    }
		
    $criteria->addJoin(self::ID, VotePeer::ARTICLE_ID, Criteria::LEFT_JOIN);
    
    $criteria->addGroupByColumn(self::ID);
    $criteria->addDescendingOrderByColumn('COUNT('.VotePeer::ID.')');
		
    return $criteria;
	}
  
	/**
	 * Get a pager of the most voted articles
	 * 
	 * @param string $start A valid strtotime() parameter
	 * @param string $end A valid strtotime() parameter
	 * @param int $page
	 * @param int $nb
	 * @param boolean $active Boolean or null for both
	 * @return sfPropelPager
	 */
	public static function getMostVoted($start = null, $end = null, $page = 1, $nb = 10, $active = true) {		
		$criteria = self::getMostVotedCriteria($start, $end, $active);
    		
    return self::getPager($criteria, $page, $nb);
	}
	
  /**
   * Get a pager of the most voted articles tagger with the supplyed tags
   * 
   * @param string $tags
   * @param string $start A valid strtotime() parameter
   * @param string $end A valid strtotime() parameter
   * @param int $page
   * @param int $nb
   * @param boolean $active Boolean or null for both
   * @return sfPropelPager
   */
  public static function getMostVotedTaggedWith($tags, $start = null, $end = null, $page = 1, $nb = 10, $active = true, $options = array()) { 
  	$criteria = TagPeer::getTaggedWithCriteria('Article', $tags, null, $options);
    $criteria = self::getMostVotedCriteria($start, $end, $active, $criteria);
        
    return self::getPager($criteria, $page, $nb);
  }
}