<h1>Administration des articles</h1>

<?php if(isset($_GET['success'])) : ?>

  <div class="alert alert-success" role="alert">
    Connecté
  </div>

<?php  endif ?>


<div style="display: flex;justify-content:flex-end;">
  <a  class="btn btn-success" href="/myapp/admin/posts/create"> Un nouvel article</a>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titre</th>
      <th scope="col">Publié le</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($params['posts'] as $post): ?>
        <tr>
            <th scope="row"><?= $post->id ?> </th>
            <td><?= $post->title ?></td>
            <td><?= $post->getCreatedAt() ?></td>
            <td>
                <a href="/myapp/admin/posts/edit/<?= $post->id ?>"class="btn btn-warning">Modifier</a>
                <form action="/myapp/admin/posts/delete/<?= $post->id ?>" method="post" style="display: inline;">
                    <button type="submit"  class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>

   
  </tbody>
</table>