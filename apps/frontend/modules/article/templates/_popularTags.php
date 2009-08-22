<?php
/**
 * HTML partial of popular tags
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Tags')
?>

<section id="popular-tags">
  <h1><?php echo __('Popular tags') ?></h1>

  <?php echo tag_cloud($tags, '@article_tags_top?tags=%s') ?>
</section>