<?php
/**
 * HTML user's articles
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<h1><?php echo __('%1%\'s articles', array('%1%' => $user)) ?></h1>

<?php include_partial('article/list', array('article_pager' => $article_pager)) ?>