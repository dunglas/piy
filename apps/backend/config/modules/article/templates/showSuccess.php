<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $article->getId() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $article->getSlug() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $article->getTitle() ?></td>
    </tr>
    <tr>
      <th>Body:</th>
      <td><?php echo $article->getBody() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $article->getUserId() ?></td>
    </tr>
    <tr>
      <th>Author:</th>
      <td><?php echo $article->getAuthor() ?></td>
    </tr>
    <tr>
      <th>Hits:</th>
      <td><?php echo $article->getHits() ?></td>
    </tr>
    <tr>
      <th>Blocks:</th>
      <td><?php echo $article->getBlocks() ?></td>
    </tr>
    <tr>
      <th>Agenda date:</th>
      <td><?php echo $article->getAgendaDate() ?></td>
    </tr>
    <tr>
      <th>Agenda location:</th>
      <td><?php echo $article->getAgendaLocation() ?></td>
    </tr>
    <tr>
      <th>Agenda latitude:</th>
      <td><?php echo $article->getAgendaLatitude() ?></td>
    </tr>
    <tr>
      <th>Agenda longitude:</th>
      <td><?php echo $article->getAgendaLongitude() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $article->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $article->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('article/edit?id='.$article->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('article/index') ?>">List</a>
