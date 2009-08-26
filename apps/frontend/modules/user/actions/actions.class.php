<?php
/**
 * User actions
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class userActions extends sfActions
{
  /**
   * Displays the user's articles
   *
   * @param sfWebRequest $request
   */
  public function executeArticles(sfWebRequest $request) {
    $this->forward404Unless(
      $this->user = sfGuardUserPeer::retrieveByUsername(
        $request->getParameter('username')
      )
    );

    $this->article_pager = ArticlePeer::getMostRecentPublishedBy($this->user, $request->getParameter('page', 1));

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('Articles of %1%', array('%1%' => $this->user))
    ));
  }

  /**
   * Displays user's comments
   *
   * @param sfWebRequest $request
   */
  public function executeComments(sfWebRequest $request) {
    $this->forward404Unless(
      $this->user = sfGuardUserPeer::retrieveByUsername(
        $request->getParameter('username')
      )
    );
    
    $this->comments_pager = sfCommentPeer::getPublishedBy($this->user);

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('Comments of %1%', array('%1%' => $this->user))
    ));
  }
}