<?php

namespace Paolo\Myapp;
use Database\DBConnetion;
 
class Route { 
 
 
	public $path;
    public $action;
    public $matches;
 
 
public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }
 
 
 
    public function matches( $url)
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);//on filtre l'url de ces caractères pour récupérer les paramètre envoyer dans 'url
        $pathToMatch = "#^$path$#";
        
        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }
 
 /**
  * instanciation de la connexion
  */
public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0]( new DBConnetion(DB_NAME, DB_HOST , DB_USER ,DB_PWD));//on récupère le controleur
        $method = $params[1];
 
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();//matches contient le paramètre dans 'url donc s'il existe un paramètre on le passe à la mfunction du controleur
    }
 
 
}
