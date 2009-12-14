<?php
/**
 * HTML tags partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
<?php echo _('Tags:') ?>
<ul class="tags">
  <?php foreach ($tags as $tag): ?>
    <li><?php echo link_to($tag, '@article_tags_top?tags='.$tag, array('rel' => 'tag')) ?></li>
  <?php endforeach ?>
</ul>