<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
    <div id="container">
	    <div id="title">
	      <strong><?php echo link_to(sfConfig::get('app_general_name'), '@homepage') ?></strong>
	      <div class="baseline"><?php echo sfConfig::get('app_general_baseline') ?></div>
	    </div>
	    <?php if ($sf_user->hasFlash('message')): ?>
	    <div id="message">
	      <?php echo $sf_user->getFlash('message') ?>
	    </div>
	    <?php endif ?>
	    
	    <div id="content">
	      <?php echo $sf_content ?>
	    </div>
	    
	    <?php include_component('article', 'mostRecent') ?>
	    
	    <div id="user">
		    <?php if ($sf_user->isAuthenticated()): ?>
		    <p><?php echo __('Welcome <strong>%1%</strong> !', array('%1%' => $sf_user)) ?></p>
		    <ul>
		      <li><?php echo link_to(__('Sign out'), '@sf_guard_signout') ?></li>
		    </ul>
		    <?php else: ?>
		    <h3><?php echo __('Sign in') ?></h3>
		    <?php include_component('sfGuardAuth', 'signin') ?>
				<?php endif ?>
	    </div>
    </div>
  </body>
</html>