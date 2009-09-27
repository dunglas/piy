<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>

    <?php if (has_slot('atom')): ?>
      <?php include_slot('atom') ?>
    <?php endif ?>
    <link rel="alternate" type="application/atom+xml" title="<?php echo __('Homepage articles') ?>" href="<?php echo url_for('@article_top_one_page?sf_format=atom', true) ?>" />
    <link rel="alternate" type="application/atom+xml" title="<?php echo __('Most recent articles') ?>" href="<?php echo url_for('@article_most_recent_one_page?sf_format=atom', true) ?>" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="container">
      <?php if ($sf_user->hasFlash('message')): ?>
      <p class="message"><?php echo $sf_user->getFlash('message') ?></p>
      <?php endif ?>

      <header id="title">
        <strong><?php echo link_to(sfConfig::get('app_general_name'), '@homepage') ?></strong>
        <div class="baseline"><?php echo sfConfig::get('app_general_baseline') ?></div>
      </header>
      <?php if ($sf_user->hasFlash('message')): ?>
      <section id="message">
          <?php echo $sf_user->getFlash('message') ?>
      </section>
      <?php endif ?>

      <div id="content">
        <?php echo $sf_content ?>
      </div>

      <div id="sidebar">
        <?php include_component_slot('sidebar') ?>
      </div>

      <section id="user">
        <?php if ($sf_user->isAuthenticated()): ?>
        <p><?php echo __('Welcome %1%!', array('%1%' => '<strong>'.link_to($sf_user, '@user_articles?username='.$sf_user->getGuardUser()->getUsername()).'</strong>')) ?></p>
        <ul>
          <li><?php echo link_to(__('Edit your profile'), '@sf_guard_edit_profile') ?></li>
          <li><?php echo link_to(__('Sign out'), '@sf_guard_signout') ?></li>
        </ul>
        <?php else: ?>
        <h3><?php echo __('Sign in') ?></h3>
          <?php include_component('sfZendOpenIdAuth', 'signin') ?>
        <?php endif ?>
      </section>
    </div>
  </body>
</html>