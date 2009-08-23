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
   * Displays the sidebar
   * @param sfWebRequest $request
   */
  public function executeSidebar(sfWebRequest $request) {
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
}