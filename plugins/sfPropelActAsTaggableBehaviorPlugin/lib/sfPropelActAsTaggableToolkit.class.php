<?php
/*
 * This file is part of the sfPropelActAsTaggableBehavior package.
 *
 * (c) 2007 Xavier Lacot <xavier@lacot.org>
 * (c) 2007 Michael Nolan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class sfPropelActAsTaggableToolkit
{
  /**
   * "Cleans" a string in order it to be used as a tag. Intended for strings
   * representing a single tag
   *
   * @param      String    $tag
   * @return     bool
   */
  public static function cleanTagName($tag)
  {
    return trim(rtrim(str_replace(',', ' ', $tag)));
  }

  /**
   * "Cleans" a string in order it to be used as a tag
   * Intended for strings representing a single tag
   *
   * @param      mixed     $tag
   * @return     mixed
   */
  public static function explodeTagString($tag)
  {
    if (is_string($tag)
        && (false !== strpos($tag, ',') || preg_match('/\n/', $tag)))
    {
      $tag = preg_replace('/\r?\n/', ',', $tag);
      $tag = explode(',', $tag);
      $tag = array_map('trim', $tag);
      $tag = array_map('rtrim', $tag);
    }

    return $tag;
  }

  /**
   * Extract triple tag values from tag.  Returned array will contain four
   * elements: tagname (same as input), namespace, key and value.
   *
   * @param      string     $tag
   * @return     array
   */
  public static function extractTriple($tag)
  {
    $match = preg_match('/^([A-Za-z][A-Za-z0-9_]*):([A-Za-z][A-Za-z0-9_]*)=(.*)$/', $tag, $triple);

    if ($match)
    {
      return $triple;
    }
    else
    {
      return array($tag, null, null, null);
    }
  }

  /**
   * Formats a tag string/array in a pretty string. For instance, will convert
   * tag3,tag1,tag2 into the following string : "tag1", "tag2" and "tag3"
   *
   * @param      array    $tags
   * @return     String
   */
  public static function formatTagString($tags)
  {
    $result = '';
    $sf_i18n = sfContext::getInstance()->getI18n();

    if (is_string($tags))
    {
      $tags = explode(',', $tags);
    }

    $nb_tags = count($tags);

    if ($nb_tags > 0)
    {
      sort($tags, SORT_LOCALE_STRING);
      $i = 0;

      foreach ($tags as $tag)
      {
        $result .= '"'.$tag.'"';
        $i++;

        if ($i == $nb_tags - 1)
        {
          $result .= ' '.$sf_i18n->__('and').' ';
        }
        elseif ($i < $nb_tags)
        {
          $result .= ', ';
        }
      }
    }

    return $result;
  }

  /**
   * Returns true if the passed model name is taggable
   *
   * @param      mixed     $model
   * @return     boolean
   */
  public static function isTaggable($model)
  {
    if (is_object($model))
    {
      $model = get_class($model);
    }

    if (!is_string($model))
    {
      throw new Exception('The param passed to the method isTaggable must be an object or a string.');
    }

    $base_class = sprintf('Base%s', ucfirst($model));
    $callables = sfMixer::getCallables($base_class.':save:post');
    $callables_count = count($callables);
    $i = 0;
    $is_taggable = false;

    while (!$is_taggable && ($i < $callables_count))
    {
      $callable = $callables[$i][0];
      $is_taggable = (is_object($callable)
                      && (get_class($callable) == 'sfPropelActAsTaggableBehavior'));
      $i++;
    }

    return $is_taggable;
  }

  /**
   * Normalizes a tag cloud, ie. changes a (tag => weight) array into a
   * (tag => normalized_weight) one. Normalized weights range from -2 to 2.
   *
   * @param      array  $tag_cloud
   * @return     array
   */
  public static function normalize($tag_cloud)
  {
    $tags = array();
    $levels = 5;
    $power = 0.7;

    if (count($tag_cloud) > 0)
    {
      $max_count = max($tag_cloud);
      $min_count = min($tag_cloud);
      $max = intval($levels / 2);

      if ($max_count != 0)
      {
        foreach ($tag_cloud as $tag => $count)
        {
          $tags[$tag] = round(.9999 * $levels * (pow($count/$max_count, $power) - .5), 0);
        }
      }
    }

    return $tags;
  }
}
