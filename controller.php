<?php
include_once 'db.php';
class Controller extends db
{

    function getController()
    {
        $query = $this->connect()->query('SELECT * FROM controller');
        return $query;
    }
    function obtenerController($IdController){
        $query = $this->connect()->prepare('SELECT * FROM controller WHERE IdController = :IdController');
        $query->execute(['IdController' => $IdController]);
        return $query;
    }
}?>