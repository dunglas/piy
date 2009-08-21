<?php
/**
 * List article Atom partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('XssSafe')
?>
<?php foreach ($article_pager->getResults() as $article): ?>
  <?php include_partial('article/entry', array('article' => $article)) ?>
<?php endforeach ?>