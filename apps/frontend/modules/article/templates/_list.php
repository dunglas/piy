<?php use_helper('Date') ?>

<h1><?php echo __('Articles') ?></h1>

<?php if ($article_pager->getNbResults()): ?>
	<div class="hfeed">
	<?php foreach ($article_pager->getResults() as $article): ?>
	  <div class="hentry">
	  <?php include_partial('excerpt', array('article' => $article)) ?>
	  </div>
	<?php endforeach; ?>
	
	<?php include_partial('global/pager', array('pager' => $article_pager, 'route' => $route, 'param' => $params)) ?>
	</div>
<?php else: ?>
	<p><?php echo __('No article since this time.'); ?></p>
<?php endif ?>

<p><?php echo link_to(__('New article'), '@article_new') ?></p>