<?php

/**
 * Article actions
 *
 * @package    piy
 * @subpackage article
 * @author     Kévin Dunglas <dunglas@gmail.com>
 */
class articleActions extends sfActions
{
  /**
   * Displays most recents articles
   *
   * @param sfWebRequest $request
   */
  public function executeMostRecent(sfWebRequest $request)
  {
    $this->article_pager = ArticlePeer::getMostRecent($request->getParameter('page', 1));

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('Most recent articles')
    ));
  }

  /**
   * Displays most rated articles for a given period
   *
   * @param sfWebRequest $request
   */
  public function executeTop(sfWebRequest $request)
  {
  	$start = $this->processTimeArg($request);
  	$this->article_pager = ArticlePeer::getMostRated($start, time(), $request->getParameter('page', 1));

    $this->title = $this->getContext()->getI18N()->__('Most rated articles %1%', array('%1%' => $this->timeToText($request)));
    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->title
    ));
  }

  /**
   * Displays most recents articles for a given tags
   *
   * @param sfWebRequest $request
   */
  public function executeMostRecentWithTags(sfWebRequest $request)
  {
    $this->article_pager = ArticlePeer::getMostRecentTaggedWith($request->getParameter('tags'), $request->getParameter('page', 1));
  }

  /**
   * Displays most rated articles for a given period and tags
   *
   * @param sfWebRequest $request
   */
  public function executeTopWithTags(sfWebRequest $request)
  {
  	$start = $this->processTimeArg($request);
  	$this->article_pager = ArticlePeer::getMostRatedTaggedWith($request->getParameter('tags'), $start, time(), $request->getParameter('page', 1));

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $request->getParameter('tags')
    ));
  }

  /**
   * Displays the form to create a new article
   *
   * @param sfWebRequest $request
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ArticleForm(null,
      array(
        'user' => $this->getUser()->getGuardUser(),
        'url' => $this->generateUrl('article_select_tag')
      )
    );

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('New article')
    ));
  }

  /**
   * Creates a new article
   *
   * @param sfWebRequest $request
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ArticleForm(null,
      array(
        'user' => $this->getUser()->getGuardUser(),
        'url' => $this->generateUrl('article_select_tag')
      )
    );

    $this->processForm($request, $this->form);

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('New article')
    ));
    $this->setTemplate('new');
  }

  /**
   * Displays the form to edit an article
   *
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless(
      ($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')))
      && $article->getUserId() == $this->getUser()->getGuardUser()->getUserId()
    );
    $this->form = new ArticleForm($article,
      array(
        'user' => $this->getUser()->getGuardUser(),
        'url' => $this->generateUrl('article_select_tag')
      )
    );

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('Edit %1%', array('%1%' => $article))
    ));
  }

  /**
   * Updates an article
   *
   * @param sfWebRequest $request
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless(
      ($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')))
      && $article->getUserId() == $this->getUser()->getGuardUser()->getUserId()
    );
    $this->form = new ArticleForm($article,
      array(
        'user' => $this->getUser()->getGuardUser(),
        'url' => $this->generateUrl('article_select_tag')
      )
    );

    $this->processForm($request, $this->form);

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('Edit %1%', array('%1%' => $article))
    ));
    $this->setTemplate('edit');
  }

  /**
   * Views an article
   *
   * @param sfWebRequest $request
   */
  public function executeView(sfWebRequest $request) {
  	$this->forward404Unless($this->article = ArticlePeer::retrieveBySlug($request->getParameter('slug')));

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->article
    ));
  }

  /**
   * Votes for an article
   *
   * @param sfWebRequest $request
   */
  public function executeVote(sfWebRequest $request)
  {
  	$this->forward404Unless($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')));
  	
  	$this->getUser()->getGuardUser()->voteFor($article);
  	$this->getUser()->setFlash('message', $this->getContext()->getI18N()->__('Your vote has been recorded'));
  	
  	$this->redirect('@article_view?slug='.$article->getSlug());
  }

  /**
   * Removes a vote for an article
   *
   * @param sfWebRequest $request
   */
	public function executeUnvote(sfWebRequest $request)
  {
    $this->forward404Unless($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')));
    
    $vote = $this->getUser()->getGuardUser()->getVoteFor($article);
    $vote->delete();
    $this->getUser()->setFlash('message', $this->getContext()->getI18N()->__('Your vote has been deleted'));
    
    $this->redirect('@article_view?slug='.$article->getSlug());
  }

  /**
   * Displays a JSON encoded tags array
   *
   * @param sfWebRequest $request
   * @return string
   */
  public function executeSelectTag(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    $tags = piyTagPeer::retrieveForSelect($request->getParameter('tag'));

    return $this->renderText(json_encode($tags));
  }

  /**
   * Processes an article form
   *
   * @param sfWebRequest $request
   * @param sfForm $form
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $article = $form->save();

      $this->redirect('@article_view?slug='.$article->getSlug());
    }
  }

  /**
   * Transforms the parameters to a time
   *
   * @param sfWebRequest $request
   * @return int
   */
  protected function processTimeArg(sfWebRequest $request) {
    if ($request->getParameter('time') == 'ever') $start = null;
    else $start = strtotime('-'.str_replace('-', ' ', $request->getParameter('time', '24-hours')));
    
    $this->forward404Unless($start !== false);
    
    return $start;
  }

  /**
   * Converts the time parameter to human readable text
   *
   * @param sfWebRequest $request
   * @return string
   */
  protected function timeToText(sfWebRequest $request) {
    if ($request->getParameter('time') == 'ever')
      return $this->getContext()->getI18N()->__('ever');

    return $this->getContext()->getI18N()->__('for '.str_replace('-', ' ', $request->getParameter('time')));
  }
}
