<?php
/*
 * This file is part of the sfPropelActAsTaggableBehavior package.
 *
 * (c) 2007 Xavier Lacot <xavier@lacot.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Subclass for performing query and update operations on the 'tag' table.
 *
 * @package plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model
 */
class TagPeer extends BaseTagPeer
{
  /**
   * Returns all tags, eventually with a limit option.
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      Criteria    $c
   * @param      array       $options
   * @return     array
   */
  public static function getAll(Criteria $c = null, $options = array())
  {
    if ($c == null)
    {
      $c = new Criteria();
    }

    if (isset($options['limit']))
    {
      $c->setLimit($options['limit']);
    }

    if (isset($options['like']))
    {
      $c->add(TagPeer::NAME, $options['like'], Criteria::LIKE);
    }

    if (isset($options['triple']))
    {
      $c->add(TagPeer::IS_TRIPLE, $options['triple']);
    }

    if (isset($options['namespace']))
    {
      $c->add(TagPeer::TRIPLE_NAMESPACE, $options['namespace']);
    }

    if (isset($options['key']))
    {
      $c->add(TagPeer::TRIPLE_KEY, $options['key']);
    }

    if (isset($options['value']))
    {
      $c->add(TagPeer::TRIPLE_VALUE, $options['value']);
    }

    return TagPeer::doSelect($c);
  }

  /**
   * Returns all tags, sorted by name, with their number of occurencies.
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      Criteria    $c
   * @param      array       $options
   * @return     array
   */
  public static function getAllWithCount(Criteria $c = null, $options = array())
  {
    $tags = array();

    if (null === $c)
    {
      $c = new Criteria();
    }

    if (isset($options['limit']))
    {
      $c->setLimit($options['limit']);
    }

    if (isset($options['model']))
    {
      $c->add(TaggingPeer::TAGGABLE_MODEL, $options['model']);
    }

    if (isset($options['like']))
    {
      $c->add(TagPeer::NAME, $options['like'], Criteria::LIKE);
    }

    if (isset($options['triple']))
    {
      $c->add(TagPeer::IS_TRIPLE, $options['triple']);
    }

    if (isset($options['namespace']))
    {
      $c->add(TagPeer::TRIPLE_NAMESPACE, $options['namespace']);
    }

    if (isset($options['key']))
    {
      $c->add(TagPeer::TRIPLE_KEY, $options['key']);
    }

    if (isset($options['value']))
    {
      $c->add(TagPeer::TRIPLE_VALUE, $options['value']);
    }

    $c->addSelectColumn(TagPeer::NAME);
    $c->addSelectColumn('COUNT('.TagPeer::NAME.') as counter');
    $c->addJoin(TagPeer::ID, TaggingPeer::TAG_ID);
    $c->addGroupByColumn(TaggingPeer::TAG_ID);
    $c->addDescendingOrderByColumn('counter');
    $c->addAscendingOrderByColumn(TagPeer::NAME);

    if (Propel::VERSION >= '1.3')
    {
      $rs = TagPeer::doSelectStmt($c);

      while ($row = $rs->fetch(PDO::FETCH_NUM))
      {
        $tags[$row[0]] = $row[1];
      }
    }
    else
    {
      $rs = TagPeer::doSelectRS($c);

      while ($rs->next())
      {
        $tags[$rs->getString(1)] = $rs->getInt(2);
      }
    }

    if (!isset($options['sort_by_popularity']) || (true !== $options['sort_by_popularity']))
    {
      ksort($tags);
    }

    return $tags;
  }

  /**
   * Returns the names of the models that have instances tagged with one or
   * several tags. The optionnal parameter might be a string, an array, or a
   * comma separated string
   *
   * @param      mixed       $tags
   * @return     array
   */
  public static function getModelsTaggedWith($tags = array())
  {
    if (is_string($tags))
    {
      if (false !== strpos($tags, ','))
      {
        $tags = explode(',', $tags);
      }
      else
      {
        $tags = array($tags);
      }
    }

    $c = new Criteria();
    $c->addJoin(TagPeer::ID, TaggingPeer::TAG_ID);
    $c->add(TagPeer::NAME, $tags, Criteria::IN);
    $c->addGroupByColumn(TaggingPeer::TAGGABLE_ID);
    $having = $c->getNewCriterion(TagPeer::COUNT, count($tags), Criteria::GREATER_EQUAL);
    $c->addHaving($having);
    $c->clearSelectColumns();
    $c->addSelectColumn(TaggingPeer::TAGGABLE_MODEL);
    $c->addSelectColumn(TaggingPeer::TAGGABLE_ID);

    $params = array();
    $sql = BasePeer::createSelectSql($c, $params);
    $con = Propel::getConnection();
    $stmt = $con->prepareStatement($sql);
    $position = 1;

    foreach ($tags as $tag)
    {
      $stmt->setString($position, $tag);
      $position++;
    }

    $stmt->setString($position, count($tags));
    $models = array();

    if (Propel::VERSION >= '1.3')
    {
      $rs = $stmt->query();

      while ($rs->fecth(PDO::FETCH_NUM))
      {
        $models[] = $rs->getString(1);
      }
    }
    else
    {
      $rs = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);

      while ($rs->next())
      {
        $models[] = $rs->getString(1);
      }
    }

    return $models;
  }

  /**
   * Returns the most popular tags with their associated weight. See
   * sfPropelActAsTaggableToolkit::normalize for more details.
   *
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      Criteria    $c
   * @param      array       $options
   * @return     array
   */
  public static function getPopulars($c = null, $options = array())
  {
    if (null === $c)
    {
      $c = new Criteria();
    }

    if (!$c->getLimit())
    {
      $c->setLimit(sfConfig::get('app_sfPropelActAsTaggableBehaviorPlugin_limit', 100));
    }

    $all_tags = TagPeer::getAllWithCount($c, $options);
    return sfPropelActAsTaggableToolkit::normalize($all_tags);
  }

  /**
   * Returns the tags that are related to one or more other tags, with their
   * associated weight (see sfPropelActAsTaggableToolkit::normalize for more
   * details).
   * The "related tags" of one tag are the ones which have at least one
   * taggable object in common.
   *
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      mixed       $tags
   * @param      array       $options
   * @return     array
   */
  public static function getRelatedTags($tags = array(), $options = array())
  {
    $tags = sfPropelActAsTaggableToolkit::explodeTagString($tags);

    if (is_string($tags))
    {
      $tags = array($tags);
    }

    $tagging_options = $options;

    if (isset($tagging_options['limit']))
    {
      unset($tagging_options['limit']);
    }

    $taggings = self::getTaggings($tags, $tagging_options);
    $result = array();

    foreach ($taggings as $key => $tagging)
    {
      $c = new Criteria();
      $c->add(TagPeer::NAME, $tags, Criteria::NOT_IN);
      $c->add(TaggingPeer::TAGGABLE_ID, $tagging, Criteria::IN);
      $c->add(TaggingPeer::TAGGABLE_MODEL, $key);
      $c->addJoin(TaggingPeer::TAG_ID, TagPeer::ID);
      $tag_objects = TagPeer::doSelect($c);

      foreach ($tag_objects as $tag)
      {
        if (!isset($result[$tag->getName()]))
        {
          $result[$tag->getName()] = 0;
        }

        $result[$tag->getName()]++;
      }
    }

    if (isset($options['limit']))
    {
      arsort($result);
      $result = array_slice($result, 0, $options['limit'], true);
    }

    ksort($result);
    return sfPropelActAsTaggableToolkit::normalize($result);
  }

  /**
   * Retrieves the objects tagged with one or several tags.
   *
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      mixed       $tags
   * @param      array       $options
   * @return     array
   */
  public static function getTaggedWith($tags = array(), $options = array())
  {
    $taggings = self::getTaggings($tags, $options);
    $result = array();

    foreach ($taggings as $key => $tagging)
    {
      $c = new Criteria();
      $peer = get_class(call_user_func(array(new $key, 'getPeer')));
      $objects = call_user_func(array($peer, 'retrieveByPKs'), $tagging);

      foreach ($objects as $object)
      {
        $result[] = $object;
      }
    }

    return $result;
  }

  /**
   * Retrieve a Criteria instance for querying tagged model objects.
   *
   * Example:
   *
   * $c = TagPeer::getTaggedWithCriteria('Article', array('tag1', 'tag2'));
   * $c->addDescendingOrderByColumn(ArticlePeer::POSTED_AT);
   * $c->setLimit(10);
   * $this->articles = ArticlePeer::doSelectJoinAuthor($c);
   *
   * @param  string    $model  Taggable model name
   * @param  mixed     $tags   array of tags (can be a string where tags are
   * comma separated)
   * @param  Criteria  $c      Existing Criteria to hydrate
   * @return Criteria
   */
  public static function getTaggedWithCriteria($model, $tags = array(), Criteria $c = null, $options = array())
  {
    $tags = sfPropelActAsTaggableToolkit::explodeTagString($tags);

    if (is_string($tags))
    {
      $tags = array($tags);
    }

    if (!$c instanceof Criteria)
    {
      $c = new Criteria();
    }

    if (!class_exists($model) || !is_callable(array(new $model, 'getPeer')))
    {
      throw new PropelException(sprintf('The class "%s" does not exist, or it is not a model class.',
                                        $model));
    }

    $options['model'] = $model;
    $taggings = self::getTaggings($tags, $options);
    $tagging = isset($taggings[$model]) ? $taggings[$model] : array();
    $peer = get_class(call_user_func(array(new $model, 'getPeer')));
    $c->add(constant($peer.'::ID'), $tagging, Criteria::IN);

    return $c;
  }

  /**
   * Returns the taggings associated to one tag or a set of tags.
   *
   * The second optionnal parameter permits to restrict the results with
   * different criterias
   *
   * @param      mixed       $tags      Array of tag strings or string
   * @param      array       $options   Array of options parameters
   * @return     array
   */
  public static function getTaggings($tags = array(), $options = array())
  {
    $tags = sfPropelActAsTaggableToolkit::explodeTagString($tags);

    if (is_string($tags))
    {
      $tags = array($tags);
    }

    $c = new Criteria();
    $c->addJoin(TagPeer::ID, TaggingPeer::TAG_ID);

    if (count($tags) > 0)
    {
      $c->add(TagPeer::NAME, $tags, Criteria::IN);
      $having = $c->getNewCriterion('COUNT('.TaggingPeer::TAGGABLE_MODEL.') ', count($tags), Criteria::GREATER_EQUAL);
      $c->addHaving($having);
    }

    $c->addGroupByColumn(TaggingPeer::TAGGABLE_ID);
    $c->clearSelectColumns();
    $c->addSelectColumn(TaggingPeer::TAGGABLE_MODEL);
    $c->addSelectColumn(TaggingPeer::TAGGABLE_ID);

    // Taggable model class option
    if (isset($options['model']))
    {
      if (!class_exists($options['model']) || !is_callable(array(new $options['model'], 'getPeer')))
      {
        throw new PropelException(sprintf('The class "%s" does not exist, or it is not a model class.',
                                          $options['model']));
      }

      $c->add(TaggingPeer::TAGGABLE_MODEL, $options['model']);
    }
    else
    {
      $c->addGroupByColumn(TaggingPeer::TAGGABLE_MODEL);
    }

    if (isset($options['triple']))
    {
      $c->add(TagPeer::IS_TRIPLE, $options['triple']);
    }

    if (isset($options['namespace']))
    {
      $c->add(TagPeer::TRIPLE_NAMESPACE, $options['namespace']);
    }

    if (isset($options['key']))
    {
      $c->add(TagPeer::TRIPLE_KEY, $options['key']);
    }

    if (isset($options['value']))
    {
      $c->add(TagPeer::TRIPLE_VALUE, $options['value']);
    }

    $param = array();
    $sql = BasePeer::createSelectSql($c, $param);
    $con = Propel::getConnection();

    if (Propel::VERSION < '1.3')
    {
      $stmt = $con->prepareStatement($sql);
      $position = 1;

      foreach ($tags as $tag)
      {
        $stmt->setString($position, $tag);
        $position++;
      }

      if (isset($options['model']))
      {
        $stmt->setString($position, $options['model']);
        $position++;
      }

      if (isset($options['triple']))
      {
        $stmt->setBoolean($position, $options['triple']);
        $position++;
      }

      if (isset($options['namespace']))
      {
        $stmt->setString($position, $options['namespace']);
        $position++;
      }

      if (isset($options['key']))
      {
        $stmt->setString($position, $options['key']);
        $position++;
      }

      if (isset($options['value']))
      {
        $stmt->setString($position, $options['value']);
        $position++;
      }
    }
    else
    {
      $stmt = $con->prepare($sql);
      $position = 1;

      foreach ($tags as $tag)
      {
        $stmt->bindValue(':p'.$position, $tag, PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['model']))
      {
        $stmt->bindValue(':p'.$position, $options['model'], PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['triple']))
      {
        $stmt->bindValue(':p'.$position, $options['triple']);
        $position++;
      }

      if (isset($options['namespace']))
      {
        $stmt->bindValue(':p'.$position, $options['namespace'], PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['key']))
      {
        $stmt->bindValue(':p'.$position, $options['key'], PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['value']))
      {
        $stmt->bindValue(':p'.$position, $options['value'], PDO::PARAM_STR);
        $position++;
      }
    }

    if (!isset($options['nb_common_tags'])
        || ($options['nb_common_tags'] > count($tags)))
    {
      $options['nb_common_tags'] = count($tags);
    }

    if ($options['nb_common_tags'] > 0)
    {
      if (Propel::VERSION >= '1.3')
      {
        $stmt->bindValue(':p'.$position, $options['nb_common_tags'], PDO::PARAM_STR);
      }
      else
      {
        $stmt->setString($position, $options['nb_common_tags']);
      }
    }

    $taggings = array();

    if (Propel::VERSION >= '1.3')
    {
      $rs = $stmt->execute();

      while ($row = $stmt->fetch(PDO::FETCH_NUM))
      {
        $model = $row[0];

        if (!isset($taggings[$model]))
        {
          $taggings[$model] = array();
        }

        $taggings[$model][] = $row[1];
      }
    }
    else
    {
      $rs = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);

      while ($rs->next())
      {
        $model = $rs->getString(1);

        if (!isset($taggings[$model]))
        {
          $taggings[$model] = array();
        }

        $taggings[$model][] = $rs->getInt(2);
      }
    }

    return $taggings;
  }

  /**
   * Retrives a tag by his name.
   *
   * @param      String      $tagname
   * @return     Tag
   */
  public static function retrieveByTagname($tagname)
  {
    $c = new Criteria();
    $c->add(TagPeer::NAME, $tagname);
    return TagPeer::doSelectOne($c);
  }

  /**
   * Retrieves a tag by his name. If it does not exist, creates it (but does not
   * save it)
   *
   * @param      String      $tagname
   * @return     Tag
   */
  public static function retrieveOrCreateByTagname($tagname)
  {
    // retrieve or create the tag
    $tag = TagPeer::retrieveByTagName($tagname);

    if (!$tag)
    {
      $tag = new Tag();
      $tag->setName($tagname);
      $triple = sfPropelActAsTaggableToolkit::extractTriple($tagname);
      list($tagname, $triple_namespace, $triple_key, $triple_value) = $triple;
      $tag->setTripleNamespace($triple_namespace);
      $tag->setTripleKey($triple_key);
      $tag->setTripleValue($triple_value);
      $tag->setIsTriple(!is_null($triple_namespace));
    }

    return $tag;
  }
}