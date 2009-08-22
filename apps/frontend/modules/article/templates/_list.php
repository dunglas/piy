<?php
/**
 * List partial
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

use_helper('Date')
?>
<?php if ($article_pager->getNbResults()): ?>
	<div class="hfeed">
	<?php foreach ($article_pager->getResults() as $article): ?>
	  <div class="hentry">
	  <?php include_partial('excerpt', array('article' => $article)) ?>
	  </div>
	<?php endforeach; ?>
	
	<?php include_component('utils', 'pager', array('pager' => $article_pager)) ?>
	</div>
<?php else: ?>
	<p><?php echo __('No article match your selection.'); ?></p>
<?php endif ?>

<p><?php echo link_to(__('New article'), '@article_new') ?></p>