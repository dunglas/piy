<?php if ($pager->haveToPaginate()): ?>
  <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
    <?php echo link_to('&laquo;', $sf_data->getRaw('uri').'page='.$pager->getFirstPage()) ?>
    <?php if ($pager->getFirstPage() != $pager->getPreviousPage()): ?>
      <?php echo link_to('&lt;', $sf_data->getRaw('uri').'page='.$pager->getPreviousPage()) ?>
    <?php endif ?>
  <?php endif ?>
  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? $page : link_to($page, $sf_data->getRaw('uri').'page='.$page) ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php if ($pager->getPage() != $pager->getLastPage()): ?>
    <?php if ($pager->getNextPage() != $pager->getLastPage()): ?>
      <?php echo link_to('&gt;', $sf_data->getRaw('uri').'page='.$pager->getNextPage()) ?>
    <?php endif ?>
    <?php echo link_to('&raquo;', $sf_data->getRaw('uri').'page='.$pager->getLastPage()) ?>
  <?php endif ?>
<?php endif ?>