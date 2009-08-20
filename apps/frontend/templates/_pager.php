<?php
$q = '?';

if (isset ($params))
	foreach ($params as $key => $value)
		$q .= $key . '=' . $value . '&';
?>

<?php if ($pager->haveToPaginate()): ?>
  <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
    <?php echo link_to('&laquo;', $route.$q.'page='.$pager->getFirstPage()) ?>
    <?php if ($pager->getFirstPage() != $pager->getPreviousPage()): ?>
      <?php echo link_to('&lt;', $route.$q.'page='.$pager->getPreviousPage()) ?>
    <?php endif ?>
  <?php endif ?>
  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? $page : link_to($page, $route.$q.'page='.$page) ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php if ($pager->getPage() != $pager->getLastPage()): ?>
    <?php if ($pager->getNextPage() != $pager->getLastPage()): ?>
      <?php echo link_to('&gt;', $route.$q.'page='.$pager->getNextPage()) ?>
    <?php endif ?>
    <?php echo link_to('&raquo;', $route.$q.'page='.$pager->getLastPage()) ?>
  <?php endif ?>
<?php endif ?>