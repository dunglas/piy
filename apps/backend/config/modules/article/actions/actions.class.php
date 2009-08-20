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
    $this->article_list = ArticlePeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->article = ArticlePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->article);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ArticleForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ArticleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($article = ArticlePeer::retrieveByPk($request->getParameter('id')), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
    $this->form = new ArticleForm($article);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($article = ArticlePeer::retrieveByPk($request->getParameter('id')), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
    $this->form = new ArticleForm($article);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($article = ArticlePeer::retrieveByPk($request->getParameter('id')), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
    $article->delete();

    $this->redirect('article/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $article = $form->save();

      $this->redirect('article/edit?id='.$article->getId());
    }
  }
}
