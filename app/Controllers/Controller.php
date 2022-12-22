<?php

namespace App\Controllers;

use Database\DBConnetion;

abstract class  Controller
{   

    protected $db;

    public function __construct(DBConnetion $db)
    {
       
        session_start();
        

        $this->db = $db;
    }


   
    protected function view( $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
       
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    protected function getDB(){
        return $this->db ;
    }
    

    protected function isAdmin()
    {
        
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
            return true;
        } else {
            return header('Location: /myapp/login');
        }
        
    }
}

