<?php
/**
 * HTML file for related tags
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Tags')
?>

<section id="related-tags">
  <h1><?php echo __('Related tags') ?></h1>
  

  <?php echo tag_cloud($tags, '@article_tags_top?tags='.$sf_params->get('tags').',%s') ?>
</section>