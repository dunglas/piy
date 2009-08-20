<?php
require_once(sfConfig::get('sf_plugins_dir').
'/sfPropelActAsCommentableBehaviorPlugin/modules/sfComment/lib/BasesfCommentComponents.class.php');

/**
 * sfPropelActAsCommentableBehaviorPlugin components. Feel free to override this
 * class in your dedicated app module.
 *
 * @package    sfPropelActAsCommentableBehaviorPlugin
 * @subpackage sfComment module
 * @author     Xavier Lacot <xavier@lacot.org>
 * @see        http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class sfCommentComponents extends BasesfCommentComponents
{
/**
   * Diplays the commenting form
   *
   * @param $request
   */
  public function executeCommentForm(sfWebRequest $request)
  {
    $this->getConfig();
    $config = sfContext::getInstance()->getUser()->isAuthenticated() ? $this->config_user : $this->config_anonymous;
    $this->layout = $config['layout'];

    if ($this->config['use_css'])
    {
      sfContext::getInstance()->getResponse()->addStylesheet('/sfPropelActAsCommentableBehaviorPlugin/css/sf_comment', 'first');
    }

    // get the list of the allowed tags
    $allowed_html_tags = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_allowed_tags', array());
    sort($allowed_html_tags);
    $this->allowed_html_tags = $allowed_html_tags;

    // build the comment form
    $sf_comment = $request->getParameter('sf_comment');
    $this->form = new sfSpCommentingForm();

    if ($request->isMethod('post') && is_array($sf_comment))
    {
      $this->form->bind($sf_comment);
    }
    else
    {
      // get the object token
      if ($this->object instanceof sfOutputEscaperObjectDecorator)
      {
        $object = $this->object->getRawValue();
      }
      else
      {
        $object = $this->object;
      }

      $this->object_model = get_class($object);
      $this->object_id = $object->getPrimaryKey();
      $token = sfPropelActAsCommentableToolkit::addTokenToSession($this->object_model, $this->object_id);

      $this->form->setDefaults(array(
        'referer' => str_replace($request->getUriPrefix(), '', $request->getUri()),
        'token'   => $token
      ));
    }
  }
}
