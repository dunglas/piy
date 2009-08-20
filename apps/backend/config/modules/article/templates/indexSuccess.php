<h1>Article List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Slug</th>
      <th>Title</th>
      <th>Body</th>
      <th>User</th>
      <th>Author</th>
      <th>Hits</th>
      <th>Blocks</th>
      <th>Agenda date</th>
      <th>Agenda location</th>
      <th>Agenda latitude</th>
      <th>Agenda longitude</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($article_list as $article): ?>
    <tr>
      <td><a href="<?php echo url_for('article/show?id='.$article->getId()) ?>"><?php echo $article->getId() ?></a></td>
      <td><?php echo $article->getSlug() ?></td>
      <td><?php echo $article->getTitle() ?></td>
      <td><?php echo $article->getBody() ?></td>
      <td><?php echo $article->getUserId() ?></td>
      <td><?php echo $article->getAuthor() ?></td>
      <td><?php echo $article->getHits() ?></td>
      <td><?php echo $article->getBlocks() ?></td>
      <td><?php echo $article->getAgendaDate() ?></td>
      <td><?php echo $article->getAgendaLocation() ?></td>
      <td><?php echo $article->getAgendaLatitude() ?></td>
      <td><?php echo $article->getAgendaLongitude() ?></td>
      <td><?php echo $article->getCreatedAt() ?></td>
      <td><?php echo $article->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('article/new') ?>">New</a>
