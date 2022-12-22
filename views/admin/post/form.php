<h1> <?= isset($params['post']->title) ? 'Modifier '. $params['post']->title : 'Créer un nouvel article' ?></h1>

<form action="<?= isset($params['post']) ? "/myapp/admin/posts/edit/{$params['post']->id}": "/myapp/admin/posts/create" ?>"  method="post">
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input type="text" class="form-control" id="title" name=" title" value="<?= $params['post']->title ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu de l'article</label>
        <textarea name="content" id="content"  rows="8" class="form-control"><?= $params['post']->content ?? '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags de l'article</label>
        <select class="form-select" name="tags[]" multiple aria-label="multiple select example">
            <?php foreach ($params['tags'] as $tag):?>
                
                <option value="<?= $tag->id ?>"
                <?php if (isset($params['post'])): ?>
                    
                        <?php foreach ($params['post']->getTags() as $postTag) {
                                echo ($tag->id == $postTag->id) ? 'selected': '';
                            }
                            
                        ?>
                        <?php endif ?>><?= $tag->name ?></option>
                

            <?php endforeach ?>
        </select>
    </div>

    <button type="submit" style="margin-top: 6px;" class="btn btn-primary"><?= isset($params['post']) ? 'Modifier' : 'Enregistrer' ?></button>
    
    
</form>