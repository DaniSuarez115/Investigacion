<?php
include_once 'db.php';
class Roles extends db
{

    function getRoles()
    {
        $query = $this->connect()->query('SELECT * FROM roles');
        return $query;

    }

    function obtenerRol($IdRol){
        $query = $this->connect()->prepare('SELECT * FROM roles WHERE IdRol = :IdRol');
        $query->execute(['IdRol' => $IdRol]);
        return $query;
    }
}


?>