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
<?php foreach ($comments as $comment): ?>
  <?php include_partial('sfComment/commentView', array('comment' => $comment)) ?>
<?php endforeach ?>