<?php
 /**
  * View class allowing theme
  * First released by François Zaninotto on http://snippets.symfony-project.org/snippet/115
  */
class piyView extends sfPHPView
{
  public function configure()
  {
    parent::configure();

    $theme = sfConfig::get('app_theme', false);

    // If there is a theme and if the theme feature is enabled
    if($theme)
    {
      // Look for templates in a $theme/ subdirectory of the usual template location
      if (is_readable($this->getDirectory().'/'.$theme.'/'.$this->getTemplate()))
      {
        $this->setDirectory($this->getDirectory().'/'.$theme);
      }

      // Look for a layout in a $theme/ subdirectory of the usual layout location
      if (is_readable($this->getDecoratorDirectory().'/'.$theme.'/'.$this->getDecoratorTemplate()))
      {
        $this->setDecoratorDirectory($this->getDecoratorDirectory().'/'.$theme);
      }
    }
  }
}