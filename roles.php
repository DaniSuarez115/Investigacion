<?php
include_once 'db.php';
class Roles extends DB
{
    function getRoles()
    {
        $query=$this->connect()->$query('SELECT * FROM roles desc' );
    }
}


?>