<?php
include_once 'db.php';
class Controller extends db
{

    function getController()
    {
        $query = $this->connect()->query('SELECT * FROM controller');
        return $query;
    }
}?>