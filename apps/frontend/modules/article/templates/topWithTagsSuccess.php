<?php
/**
 * HTML top with tags page
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
?>
<?php if ($sf_params->get('time') != '24-hours'): ?>
  <?php slot('atom') ?>
    <link rel="alternate" type="application/atom+xml" title="<?php echo __('Most rated articles tagged with %1% %2%', array('%1%' => $sf_params->get('tags'), '%2%' => $sf_params->get('time') == 'ever' ? __('ever') : __('for '.str_replace('-', ' ', $sf_params->get('time'))))) ?>" href="<?php echo url_for('@article_top_one_page?time='.$sf_params->get('time').'&sf_format=atom', true) ?>" />
  <?php end_slot() ?>
<?php endif ?>

<div id="top-selector">
	<?php echo __('Most rated articles for:') ?>

	<ul>
	  <li><?php echo $sf_params->get('time') == '24-hours' ? '<strong class="selected">' . __('24 hours') . '</strong>' : link_to(__('24 hours'), '@article_tags_top?time=24-hours&tags='.$sf_params->get('tags')) ?></li>
	  <li><?php echo $sf_params->get('time') == '1-week' ? '<strong class="selected">' . __('1 week') . '</strong>' : link_to(__('1 week'), '@article_tags_top?time=1-week&tags='.$sf_params->get('tags')) ?></li>
	  <li><?php echo $sf_params->get('time') == '1-month' ? '<strong class="selected">' . __('1 month') . '</strong>' : link_to(__('1 month'), '@article_tags_top?time=1-month&tags='.$sf_params->get('tags')) ?></li>
	  <li><?php echo $sf_params->get('time') == '1-year' ? '<strong class="selected">' . __('1 year') . '</strong>' : link_to(__('1 year'), '@article_tags_top?time=1-year&tags='.$sf_params->get('tags')) ?></li>
	  <li><?php echo $sf_params->get('time') == 'ever' ? '<strong class="selected">' . __('ever') . '</strong>' : link_to(__('ever'), '@article_tags_top?time=ever&tags='.$sf_params->get('tags')) ?></li>
	</ul>
</div>

<h1><?php echo $sf_params->get('tags') ?></h1>

<?php include_partial('article/list', array('article_pager' => $article_pager)) ?>