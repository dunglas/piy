<?php
/*
 * This file is part of the sfPropelActAsTaggableBehavior package.
 *
 * (c) 2007 Xavier Lacot <xavier@lacot.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

sfPropelBehavior::registerHooks('sfPropelActAsTaggableBehavior', array (
  ':save:post' => array ('sfPropelActAsTaggableBehavior', 'postSave'),
  ':delete:pre' => array ('sfPropelActAsTaggableBehavior', 'preDelete'),
));


sfPropelBehavior::registerMethods('sfPropelActAsTaggableBehavior', array (
  array (
    'sfPropelActAsTaggableBehavior',
    'addTag'
  ),
  array (
    'sfPropelActAsTaggableBehavior',
    'getTags'
  ),
  array (
    'sfPropelActAsTaggableBehavior',
    'hasTag'
  ),
  array (
    'sfPropelActAsTaggableBehavior',
    'removeAllTags'
  ),
  array (
    'sfPropelActAsTaggableBehavior',
    'removeTag'
  ),
  array (
    'sfPropelActAsTaggableBehavior',
    'replaceTag'
  ),
  array (
    'sfPropelActAsTaggableBehavior',
    'setTags'
  ),
));