<?php

/**
 * article actions.
 *
 * @package    selfpublish
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class articleActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->article_pager = ArticlePeer::getMostRecent($request->getParameter('page', 1));
  }
  
  public function executeTop(sfWebRequest $request) {
  	$start = $this->processTimeArg($request);
  	$this->article_pager = ArticlePeer::getMostVoted($start, time(), true, $request->getParameter('page', 1));
  	
  	$this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ArticleForm(null, array('user' => $this->getUser()->getGuardUser()));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ArticleForm(null, array('user' => $this->getUser()->getGuardUser()));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless(
      ($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')))
      && $article->getUserId() == $this->getUser()->getGuardUser()->getUserId()
    );
    $this->form = new ArticleForm($article, array('user' => $this->getUser()->getGuardUser()));
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless(
      ($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')))
      && $article->getUserId() == $this->getUser()->getGuardUser()->getUserId()
    );
    $this->form = new ArticleForm($article, array('user' => $this->getUser()->getGuardUser()));

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
  public function executeView(sfWebRequest $request) {
  	$this->forward404Unless($this->article = ArticlePeer::retrieveBySlug($request->getParameter('slug')));
  }
  
  public function executeVote(sfWebRequest $request) {
  	$this->forward404Unless($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')));
  	
  	$this->getUser()->getGuardUser()->voteFor($article);
  	$this->getUser()->setFlash('message', $this->getContext()->getI18N()->__('Your vote has been recorded'));
  	
  	$this->redirect('@article_view?slug='.$article->getSlug());
  }
  
	public function executeUnvote(sfWebRequest $request) {
    $this->forward404Unless($article = ArticlePeer::retrieveBySlug($request->getParameter('slug')));
    
    $vote = $this->getUser()->getGuardUser()->getVoteFor($article);
    $vote->delete();
    $this->getUser()->setFlash('message', $this->getContext()->getI18N()->__('Your vote has been deleted'));
    
    $this->redirect('@article_view?slug='.$article->getSlug());
  }
  
  public function executeTopTag(sfWebRequest $request) {
    $start = $this->processTimeArg($request);
    $tags = $request->getParameter('tags');
    
    $this->article_pager = ArticlePeer::getMostVotedTaggedWith($tags, $start, time(), true, $request->getParameter('page', 1));
    
    $this->setTemplate('index');
  }
  
    protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $article = $form->save();

      $this->redirect('@article_view?slug='.$article->getSlug());
    }
  }
  
  protected function processTimeArg(sfWebRequest $request) {
    if ($request->getParameter('time') == 'everytime') $start = null;
    else $start = strtotime('-'.str_replace('-', ' ', $request->getParameter('time', '24-hours')));
    
    $this->forward404Unless($start !== false);
    
    return $start;
  }
}
