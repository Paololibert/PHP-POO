<?php
namespace Paolo\Myapp;

use App\Exceptions\NotFoundException;

class Router
{
    public $url;

    public $routes = [];//sert à enregistrer les routes

    public function __construct($url)
    {
        $this->url = trim($url,'/');//trim retire içi le /
    }

    /**
     * reçoit l'url et l'action cad la fonction du controleur
     */
    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);//le get est utilisé pour les requête avec la méthode get
    }

    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }
     /**/
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {// on vérifie si la route matche avec l'url
                return $route->execute();//exécute va appeler le bon contolleur et la bonne fonction

            }
        }
        //return header('HTTP/1.0 404 Not Found');
        throw new NotFoundException("La page demander est introuvable.");
        
    }
    
// ajax clone append

}
