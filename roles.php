<?php
include_once 'db.php';
class Roles extends db
{

    function getRoles()
    {
        // $query=$this->connect()->$query('SELECT * FROM roles desc');

        $query = $this->connect()->query('SELECT * FROM roles ORDER BY IdRol DESC');
        return $query;
        // $query=$this->connect()->$query('SELECT * FROM roles desc');

        return $query;
    }
}


?>