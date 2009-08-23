<?php
/**
 * User components
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class userComponents extends sfComponents {
  /**
   * Displays the articles sidebar
   * @param sfWebRequest $request
   */
  public function executeSidebarArticles(sfWebRequest $request) {
    $this->user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
  }

  /**
   * Displays user comments
   *
   * @param sfWebRequest $request
   */
  public function executeComments(sfWebRequest $request) {
    $this->user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
    $this->comments_pager = sfCommentPeer::getPublishedBy($this->user);
  }

  /**
   * Displays the comments sidebar
   * @param sfWebRequest $request
   */
  public function executeSidebarComments(sfWebRequest $request) {
    $this->user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
  }

  /**
   * Displays user comments
   *
   * @param sfWebRequest $request
   */
  public function executeArticles(sfWebRequest $request) {
    $this->user = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
    $this->articles_pager = ArticlePeer::getMostRecentPublishedBy($this->user);
  }
}