<?php
include_once 'db.php';
class Roles extends db
{

    function getRoles()
    {
        $query = $this->connect()->query('SELECT * FROM roles');
        return $query;

    }
}


?>