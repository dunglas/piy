<?php
require_once(sfConfig::get('sf_plugins_dir').
'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

class sfGuardAuthActions extends BasesfGuardAuthActions
{
  /**
   * Registers a new user
   *
   * @param sfWebRequest $request
   */
  public function executeRegister(sfWebRequest $request)
  {
    $this->form = new sfGuardRegisterForm();

    if ($request->isMethod('post')) {
      $this->form->bind(
        $request->getParameter('sf_guard_user')
      );

      if ($this->form->isValid()) {
        $sf_guard_user = $this->form->save();

        $this->getUser()->setFlash('message',
          $this->getContext()->getI18N()->__('Welcome, you are registered. Please sign in !'));
        $this->redirect('@homepage');
      }
    }

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('Create an account')
    ));
  }


  /**
   * Retrieves the lost password of an user
   *
   * @param sfWebRequest $request
   */
  public function executePassword()
  {
    $this->form = new sfGuardUserProfileEmailForm();

    $request = $this->getRequest();
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('sf_guard_user_profile_email'));
      if ($this->form->isValid())
      {
        $profile = SfGuardUserProfilePeer::retrieveByEmail($this->form->getValue('email'));
        $profile->renewHash();
        $profile->save();

        Utils::sendMail(
          $this->form->getValue('email'),
          $this->getContext()->getI18N()->__('Recover your password'),
          $this->getPartial('sfGuardAuth/passwordMail', array('user' => $profile->getsfGuardUser(), 'hash' => $profile->getHash()))
        );
        
        $this->getUser()->setFlash(
          'message',
          $this->getContext()->getI18N()->__('Instructions to change your password have been send to your email address. Please check your mails!')
        );
        $this->redirect('@homepage');
      }
    }

    $this->getResponse()->setTitle(SEOUtils::createTitle(
      $this->getContext()->getI18N()->__('Lost password')
    ));
  }

  /**
   * Displays the form to change the password when lost
   *
   * @param sfWebRequest $request
   */
  public function executeChangePassword(sfWebRequest $request) {
    $profile = SfGuardUserProfilePeer::retrieveByHash($request->getParameter('hash'));
    if (!$profile) return sfView::ERROR;
    $this->user = $profile->getsfGuardUser();

    $this->form = new sfGuardUserChangePasswordForm($this->user);

    if ($request->isMethod('post')) {
      $this->form->bind(
        $request->getParameter('sf_guard_user')
      );

      if ($this->form->isValid()) {
        $sf_guard_user = $this->form->save();

        $this->getUser()->setFlash('message', $this->getContext()->getI18N()->__('Your password has been changed.'));
        $this->redirect('@homepage');
      }
    }
  }
}