<?php
/**
 * Atom entry tags
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

?>
  <entry>
    <title><?php echo $article->getTitle() ?></title>
    <link rel="alternate" type="text/html" href="<?php echo url_for('@article_view?slug='.$article->getSlug(), true) ?>"/>
    <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', $article->getUpdatedAt('U')) ?></updated>
    <published><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', $article->getCreatedAt('U')) ?></published>

    <?php if ($article->getUserId()): ?>
    <author>
      <name><?php echo $article->getsfGuardUser() ?></name>
      <uri><?php echo url_for('@user_articles?username='.$$article->getsfGuardUser()->getUsername(), true) ?></uri>
    </author>
    <?php else: ?>
    <author>
      <name><?php echo $article->getAuthor() ?></name>
    </author>
    <?php endif ?>

    <content type="xhtml">
      <div xmlns="http://www.w3.org/1999/xhtml">
        <?php echo $article->getBody(ESC_XSSSAFE) ?>
      </div>
    </content>
  </entry>