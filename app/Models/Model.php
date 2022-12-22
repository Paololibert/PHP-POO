<?php
namespace App\Models;

use Database\DBConnetion;
use PDO;
use stdClass;

abstract class Model
{
    protected $db;
    protected $table;

    public function  __construct(DBConnetion $db)
    {
        $this->db = $db;
    }
    
    /**
     * @return array
     */
    public function all()
    {
        //pour que les requête instancie des class : setfetchMod
        return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    }

    
    public function findByID(int $id):Model
    {
        //var_dump($stmt->fetch());
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?",[$id],true);
    }

    /**
     * @param string $sql la requête sql
     * @param array $param si c'est null c'est une query sinon un prepare
     * @param bool $single si le résultat renvoie une seule ligne
     */

    public function query($sql , $param=null, $single=null)
    {
        $method = is_null($param) ? 'query' : 'prepare';
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        if (strpos($sql, 'DELETE') === 0 || strpos($sql, 'UPDATE') === 0 || strpos($sql, 'INSERT') === 0 ) {
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);

            return $stmt->execute($param);
        }

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);

        if ($method === 'query') {
            return $stmt->$fetch();
        }else {
            $stmt->execute($param);
            return $stmt->$fetch();
        }

    }

    
    public function create(array $data, ?array $relations = null)
    {
        $firstParenthesis = "";
        $secondParenthesis = "";

        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "": ', ';
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }


        return $this->query("INSERT INTO {$this->table} ($firstParenthesis) 
        VALUES ($secondParenthesis)", $data);
    }


    public function update(int $id, array $data, ?array $relation = null)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? " ": ', ';
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";

            $i++;
        }
        $data['id'] = $id;

        

        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id= :id", $data);

        //$sql = "UPDATE {$this->table} SET title = :title, content = :content WHERE id= :id";
    }

    /*public function update(int $id, array $data)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? " ": ', ';
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";

            $i++;
        }
        $data['id'] = $id;

        

        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id= :id", $data);

        //$sql = "UPDATE {$this->table} SET title = :title, content = :content WHERE id= :id";
    }*/



    public function destroy(int $id):bool
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ? ", [$id]);
    }

}
