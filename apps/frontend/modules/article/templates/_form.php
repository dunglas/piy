<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@article_'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?slug='.$form->getObject()->getSlug() : '')) ?>" method="post"<?php $form->isMultipart() and print ' enctype="multipart/form-data"' ?>>
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
	
	<table>
	  <?php echo $form ?>
	</table>
	
	<input type="submit" value="<?php echo __('Publish !') ?>" />
</form>