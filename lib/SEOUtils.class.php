<?php
/**
 * Search engine optimization tools
 *
 * @package piy
 * @subpackage lib
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class SEOUtils {
  /**
   * Creates a title
   *
   * @param string $title
   * @param int $position
   *   * 0: before the site name
   *   * 1: after the site name
   * @param string $separator separator between the site name and the title
   */
  public static function createTitle($title, $position = 0, $separator = ' - ') {
    $sitename = sfConfig::get('app_general_name');

    if ($position)
      return $sitename . $separator . $title;

    return $title . $separator . $sitename;
  }
}