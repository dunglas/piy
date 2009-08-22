<?php
/**
 * Utils components
 *
 * @package piy
 * @subpackage utils
 * @author Kévin Dunglas <dunglas@gmail.com>
 */


class utilsComponents extends sfComponents
{
  /**
   * Displays a pagination
   *
   * @param sfWebRequest $request
   */
  public function executePager(sfWebRequest $request)
  {    
    if (!isset($this->route))
      $this->route = sfContext::getInstance()->getRouting()->getCurrentRouteName();
    if (!isset($this->params))
      $this->params = $request->getRequestParameters();

    $this->uri = '@'.$this->route.'?';
    foreach ($this->params as $key => $value) {
      if (is_string($value) && !in_array($key, array('page', 'module', 'action')))
        $this->uri .= $key . '=' . $value . '&';
    }
  }
}