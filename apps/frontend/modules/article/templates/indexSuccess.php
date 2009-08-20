<div id="top-selector">
	<?php echo __('Most rated since:') ?>
	
	<ul>
	  <li><?php echo link_to('24 hours', '@article_top?time=24-hours') ?></li>
	  <li><?php echo link_to('1 week', '@article_top?time=1-week') ?></li>
	  <li><?php echo link_to('1 month', '@article_top?time=1-month') ?></li>
	  <li><?php echo link_to('1 year', '@article_top?time=1-year') ?></li>
	  <li><?php echo link_to('everytime', '@article_top?time=everytime') ?></li>
	</ul>
</div>

<?php include_partial('article/list', array('article_pager' => $article_pager, 'route' => '@article_index', 'params' => array())) ?>