<?php
require_once(sfConfig::get('sf_plugins_dir').
'/sfPropelActAsCommentableBehaviorPlugin/modules/sfComment/lib/BasesfCommentActions.class.php');
/**
 * sfPropelActAsCommentableBehaviorPlugin actions. Feel free to override this
 * class in your dedicated app module.
 *
 * @package    sfPropelActAsCommentableBehaviorPlugin
 * @subpackage sfComment module
 * @author     Xavier Lacot <xavier@lacot.org>
 * @see        http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class sfCommentActions extends BasesfCommentActions
{
/**
   * Saves a comment
   */
  public function executeComment(sfWebRequest $request)
  {
    $this->getConfig();

    if (((sfContext::getInstance()->getUser()->isAuthenticated()
           && $this->config_user['enabled'])
          || $this->config_anonymous['enabled'])
         && $request->isMethod('post'))
    {
      $sf_comment = $request->getParameter('sf_comment');
      $this->form = new sfSpCommentingForm();
      $this->form->bind($sf_comment);

      if ($this->form->isValid())
      {
        $this->form->doSave($sf_comment);
      }
      else
      {
        $referer = str_replace($request->getScriptName(), '', $sf_comment['referer']);
        $params = $this->getContext()->getRouting()->parse($referer);
        unset($params['_sf_route']);
        $url_params = $this->getContext()->getController()->convertUrlStringToParameters($referer);
        $url_params = array_merge($params, $url_params[1]);

        foreach ($params as $param => $value)
        {
          $request->setParameter($param, $value);
        }

        $this->forward($params['module'], $params['action']);
      }

      $this->redirect($sf_comment['referer']);
    }
  }
}
