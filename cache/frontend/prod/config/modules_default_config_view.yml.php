<?php
// auto-generated by sfViewConfigHandler
// date: 2009/08/22 15:10:15
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (!is_null($layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout')))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (is_null($this->getDecoratorTemplate()) && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'Publish It Yourself', false, false);
  $response->addMeta('description', 'Publish It Yourself: A self-managed publication system', false, false);
  $response->addMeta('keywords', 'self publish, publication, self-management', false, false);
  $response->addMeta('language', 'en', false, false);
  $response->addMeta('robots', 'index, follow', false, false);

  $response->addStylesheet('main.css', '', array ());


