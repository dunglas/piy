<?php
/**
 * Atom comment list
 *
 * @package piy
 * @subpackage sfComment
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('XssSafe')
?>
<?php $i = 1; foreach ($comments as $comment): ?>
  <?php include_partial('sfComment/commentView', array('number' => $i, 'comment' => $comment)) ?>
<?php $i++; endforeach ?>