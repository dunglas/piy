<?php

/*
 * This file is part of the symfony package.
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormJQueryTagSuggestion represents a tags input widget with tag suggestion rendered by JQuery.
 *
 * This widget needs JQuery to work.
 *
 * You also need to include the JavaScripts and stylesheets files returned by the getJavaScripts()
 * and getStylesheets() methods.
 *
 * If you use symfony 1.2, it can be done automatically for you.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Kévin Dunglas <dunglas@gmail.com>
 */
class sfWidgetFormJqueryTagSuggestion extends sfWidgetFormInput
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * url:            The URL to call to get the tags to use (required)
   *  * matchClass:     Class applied to the suggestions, defaults to 'tagMatches'
   *  * tagContainer:   The type of element uses to contain the suggestions, defaults to 'span'
   *  * tagWrap:        The type of element the suggestions a wrapped in, defaults to 'span'
   *  * sort:           Boolean to force the sorted order of suggestions, defaults to false
   *  * tags:           Array of tags specific to this instance of element matches
   *  * delay:          Sets the delay between keyup and the request - can help throttle ajax requests, defaults to zero delay
   *  * separator:      Separator string, defaults to ' ' (Brian J. Cardiff)
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('url');
    $this->addOption('matchClass', 'tagMatches');
    $this->addOption('tagContainer', 'span');
    $this->addOption('tagWrap', 'span');
    $this->addOption('sort', 'false');
    $this->addOption('tags', 'null');
    $this->addOption('delay', 0);
    $this->addOption('separator', ' ');

    parent::configure($options, $attributes);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {

    return parent::render($name, $value, $attributes, $errors).
           sprintf(<<<EOF
<script type="text/javascript">
  jQuery(document).ready(function() {
    $('#%s').tagSuggest({
      url: '%s',
      matchClass: '%s',
      tagContainer: '%s',
      tagWrap: '%s',
      sort: '%s',
      tags: '%s',
      delay: %d,
      separator: '%s'
    });
  });
</script>
EOF
      ,
      $this->generateId($name),
      $this->getOption('url'),
      $this->getOption('matchClass'),
      $this->getOption('tagContainer'),
      $this->getOption('tagWrap'),
      $this->getOption('sort'),
      $this->getOption('tags'),
      $this->getOption('delay'),
      $this->getOption('separator')
    );
  }

  /**
   * Gets the stylesheet paths associated with the widget.
   *
   * @return array An array of stylesheet paths
   */
  public function getStylesheets()
  {
    return array('/sfFormExtraPlugin/css/tag.css' => 'all');
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavascripts()
  {
    return array('/sfFormExtraPlugin/js/tag.js');
  }
}
