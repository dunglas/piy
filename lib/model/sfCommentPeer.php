<?php

/**
 * Subclass for performing query and update operations on the 'sf_comment' table.
 *
 * 
 *
 * @package piy
 */ 
class sfCommentPeer extends BasesfCommentPeer
{
  /**
	 * Creates a Propel pager
	 *
	 * @param Criteria $criteria
	 * @param int $page
	 * @param int $nb
	 * @return sfPropelPager
	 */
  private static function getPager($criteria, $page = 1, $nb = 10) {
		$pager = new sfPropelPager('sfComment', $nb);
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();

    return $pager;
	}

  /**
   * Gets a pager of comments published by an user
   * 
   * @param sfGuardUser $user
   * @param int $page
   * @param int $nb
   * @return sfPropelPager
   */
  public static function getPublishedBy(sfGuardUser $user, $page = 1, $nb = 10) {
    $criteria = new Criteria();
    $criteria->add(self::AUTHOR_ID, $user->getId());
    $criteria->addDescendingOrderByColumn(self::CREATED_AT);

    return self::getPager($criteria, $page, $nb);
  }
}
