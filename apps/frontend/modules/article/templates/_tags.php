<?php
/**
 * HTML tags partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>

<div id="tags">
<strong><?php echo __('Tags:') ?></strong>
<?php foreach ($tags as $tag): ?>
  <?php echo link_to($tag, '@homepage', array('rel' => 'tag')) ?>
<?php endforeach ?>
</div>