<?php
include_once 'db.php';
class Menu extends db
{
    function getMenu()
    {
        $query = $this->connect()->query('SELECT * FROM menu');
        return $query;
    }

    function obtenerMenu($IdMenu){
        $query = $this->connect()->prepare('SELECT * FROM menu WHERE IdMenu = :IdMenu');
        $query->execute(['IdMenu' => $IdMenu]);
        return $query;
    }
}


?>