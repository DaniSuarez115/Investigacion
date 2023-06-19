<?php
include_once 'db.php';
class Menu extends db
{

    function getMenu()
    {
        $query = $this->connect()->query('SELECT * FROM menu');
        return $query;

    }
}


?>