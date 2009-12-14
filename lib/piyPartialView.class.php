<?php
/**
 * Partial View class allowing theme
 *
 */
 class piyPartialView extends sfPartialView {
   public function configure()
   {
     parent::configure();

     $themes_directory = realpath(dirname(__FILE__).'/../themes');
     $theme = sfConfig::get('app_theme_name', false);

     // If there is a theme and if the theme feature is enabled
     if($theme)
     {
       $template_directory = $themes_directory.'/'.$theme.'/'.$this->getModuleName();
       $decorator_directory = $themes_directory.'/'.$theme.'/global';

       // Look for templates in a $theme/ subdirectory of the usual template location
       if (is_readable($template_directory.'/'.$this->getTemplate()))
         $this->setDirectory($template_directory);

       // Look for a layout in a global/ subdirectory of the theme directory
       if (is_readable($decorator_directory.'/'.$this->getDecoratorTemplate()))
         $this->setDecoratorDirectory($decorator_directory);
     }
   }
 }