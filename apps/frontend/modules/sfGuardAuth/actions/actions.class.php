<?php
require_once(sfConfig::get('sf_plugins_dir').
'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

class sfGuardAuthActions extends BasesfGuardAuthActions
{
  public function executeRegister($request) {
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
  }
}