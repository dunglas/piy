<?php use_helper('Date'); ?>

<?php if (($sf_user->isAuthenticated() && $config_user['enabled'])
          || $config_anonymous['enabled']): ?>

<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<form action="<?php echo url_for('@sf_comment_comment') ?>" method="post"<?php $form->isMultipart() and print ' enctype="multipart/form-data"' ?>>  
  <table>
  <?php echo $form ?>
  </table>
  
  <input type="submit" value="<?php echo __('Comment !') ?>" />
</form>

<?php endif; ?>