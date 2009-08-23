<?php
/**
 * HTML user's articles
 *
 * @package piy
 * @subpackage user
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<?php slot('atom') ?>
  <link rel="alternate" type="application/atom+xml" title="<?php echo __('%1%\'s articles', array('%1%' => $user)) ?>" href="<?php echo url_for('@user_articles?username='.$user->getUsername().'&sf_format=atom', true) ?>" />
<?php end_slot() ?>

<h1><?php echo __('%1%\'s articles', array('%1%' => $user)) ?></h1>

<?php include_partial('article/list', array('article_pager' => $article_pager)) ?>