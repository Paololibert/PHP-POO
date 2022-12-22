<?php

namespace App\Models;

use DateTime;

class Post  extends Model
{
    protected $table = 'posts';
    //depuis que le model est chargé avec la requête nous pouvons y accéder

    public function getCreatedAt()
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
         
    }
    

    public function getExcerpt()
    {
        return substr($this->content, 0, 150). '...';
    }


    public function getButton()
    {
        return <<<HTML
        <a href="/myapp/posts/$this->id" class="btn btn-primary">Voir plus</a>
HTML;

    }

    public function getTags()
    {
        return $this->query("
        SELECT t.* FROM tags t
        INNER JOIN post_tag pt ON pt.tag_id = t.id
        
        WHERE pt.post_id  = ?
        ",[$this->id]);
    }


    public function create(array $data, ?array $relations = null)
    {
        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?) ");
            $stmt->execute([$id, $tagId]);  
        }

        return true;

    }


    public function update(int $id, array $data, ?array $relation = null)
    {
        parent::update($id, $data);

        $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([$id]);
        
        foreach ($relation as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?) ");
            $stmt->execute([$id, $tagId]);  
        }
        
        if ($result) {
            return true;
        }

    }



}
