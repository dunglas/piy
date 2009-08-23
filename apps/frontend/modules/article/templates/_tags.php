<?php
/**
 * HTML tags partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>

<section class="tags">
<h1><?php echo __('Tags') ?></h1>

  <ul>
  <?php foreach ($tags as $tag): ?>
    <li><?php echo link_to($tag, '@article_tags_top?tags='.$tag, array('rel' => 'tag')) ?></li>
  <?php endforeach ?>
  </ul>
</section>