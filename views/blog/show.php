<h1> <?= $params['post']->title ?></h1> 

    <div>
        <?php foreach($params['post']->getTags() as $tag): ?>
            <span class="badge rounded-pill bg-dark"><a style=" text-decoration:none; color:white " href="/myapp/tags/<?= $tag->id ?>"><?= $tag->name ?></a></span>
        <?php endforeach ?>
    </div>
    <small style="color:cadetblue">Publié le <?= $params['post']->getCreatedAt() ?> </small>
        

<p><?= $params['post']->content ?></p>
<a href="/myapp/posts" class="btn btn-secondary">back</a>