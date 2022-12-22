<h1><?= $params['tag']->name ?></h1>
<div class="row">


<?php  foreach ($params['tag']->getPost() as $post) : ?>
    <div class="card " style=" margin-bottom: 6px">
        <div class="card-body " >
           <a href="/myapp/posts/<?= $post->id ?>"><?= $post->title ?></a>
        </div>
    </div>
<?php endforeach ?>
</div>
