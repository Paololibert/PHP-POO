<h1>Les derniers articles</h1>
<div class="row">


<?php foreach ($params['posts'] as $post) : ?>
    <div class="card " style=" margin-bottom: 6px">
        <div class="card-body " >
            <h5 class="card-title"><?= $post->title ?></h5>
            <div>
                <?php foreach($post->getTags() as $tag): ?>
                    <span class="badge rounded-pill bg-success"><a  style=" text-decoration:none; color:white " href="/myapp/tags/<?= $tag->id ?>"><?= $tag->name ?></a></span>
                <?php endforeach ?>
            </div>
            <small style="color:cadetblue">Publié le <?= $post->getCreatedAt() ?> </small>
            <p class="card-text"><?= $post->getExcerpt() ?></p>
            <?= $post->getButton() ?>
        </div>
    </div>
<?php endforeach ?>
</div>
