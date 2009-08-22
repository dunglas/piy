<?php
/**
 * HTML most recent page
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
?>
  <h1><?php echo __('Articles') ?></h1>

<?php include_partial('article/list', array('article_pager' => $article_pager, 'route' => sfContext::getInstance()->getRouting()->getCurrentRouteName(), 'params' => array())) ?>