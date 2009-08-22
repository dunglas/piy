<?php
/**
 * HTML top page
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
?>
<?php if ($sf_params->get('time') != '24-hours'): ?>
  <?php slot('atom') ?>
    <link rel="alternate" type="application/atom+xml" title="<?php echo __('Most rated articles %1%', array('%1%' => $sf_params->get('time') == 'ever' ? __('ever') : __('for '.str_replace('-', ' ', $sf_params->get('time'))))) ?>" href="<?php echo url_for('@article_top_one_page?time='.$sf_params->get('time').'&sf_format=atom', true) ?>" />
  <?php end_slot() ?>
<?php endif ?>

<div id="top-selector">
	<?php echo __('Most rated articles for:') ?>
	
	<ul>
	  <li><?php echo $sf_params->get('time') == '24-hours' ? '<strong class="selected">' . __('24 hours') . '</strong>' : link_to(__('24 hours'), '@article_top?time=24-hours') ?></li>
	  <li><?php echo $sf_params->get('time') == '1-week' ? '<strong class="selected">' . __('1 week') . '</strong>' : link_to(__('1 week'), '@article_top?time=1-week') ?></li>
	  <li><?php echo $sf_params->get('time') == '1-month' ? '<strong class="selected">' . __('1 month') . '</strong>' : link_to(__('1 month'), '@article_top?time=1-month') ?></li>
	  <li><?php echo $sf_params->get('time') == '1-year' ? '<strong class="selected">' . __('1 year') . '</strong>' : link_to(__('1 year'), '@article_top?time=1-year') ?></li>
	  <li><?php echo $sf_params->get('time') == 'ever' ? '<strong class="selected">' . __('ever') . '</strong>' : link_to(__('ever'), '@article_top?time=ever') ?></li>
	</ul>
</div>

<h1>
  <?php echo __('Most rated articles %1%', array('%1%' => __($sf_params->get('time') == 'ever' ? __('ever') : __('for ' . str_replace('-', ' ', $sf_params->get('time')))))) ?>
</h1>

<?php include_partial('article/list', array('article_pager' => $article_pager)) ?>