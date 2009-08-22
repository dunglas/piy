<?php
/**
 * Article components
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class articleComponents extends sfComponents {
  /**
   * Displays most recent articles
   *
   * @param sfWebRequest $request
   */
	public function executeMostRecent(sfWebRequest $request) {
		$this->article_pager = ArticlePeer::getMostRecent();
	}

  /**
   * Displays a tags cloud
   *
   * @param sfWebRequest $request
   */
  public function executePopularTags(sfWebRequest $request) {
    $this->tags = TagPeer::getPopulars();
  }

  /**
   * Displays the most recent article and tags cloud block
   *
   * @param sfWebRequest $request
   */
  public function executeSidebar(sfWebRequest $request) {
  }

  public function executeRelatedTags(sfWebRequest $request) {
    $this->tags = TagPeer::getRelatedTags($request->getParameter('tags'));
  }

  public function executeMostRecentWithTags(sfWebRequest $request) {
		$this->article_pager = ArticlePeer::getMostRecentTaggedWith($request->getParameter('tags'));
	}

  public function executeTagsSidebar(sfWebRequest $request) {

  }
}