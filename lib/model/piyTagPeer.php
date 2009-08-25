<?php
/**
 * TagPeer custom
 *
 * @package piy
 * @subpackage model
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class piyTagPeer extends TagPeer {
  /**
   * Gets tags for a selector
   *
   * @param string $q
   * @param int $limit
   * @return array
   */
  static public function retrieveForSelect($q, $limit = 10)
  {
    if ($q) {
      $criteria = new Criteria();
      $criteria->add(TagPeer::NAME, '%'.$q.'%', Criteria::LIKE);
      $criteria->addAscendingOrderByColumn(TagPeer::NAME);
      $criteria->setLimit($limit);

      $tags = array();
      foreach (TagPeer::doSelect($criteria) as $tag) {
        $tags[] = $tag->getName();
      }
    } else {
      $tags = array();
      foreach (self::getPopulars() as $key => $value) {
        $tags[] = $key;
      }
    }    

    return $tags;
  }
}