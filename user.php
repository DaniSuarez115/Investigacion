<?php
include_once 'db.php';
class User extends db
{
    function getUser()
    {
        $query = $this->connect()->query('SELECT * FROM user');
        return $query;
    }
    function obtenerUser($IdUser){
        $query = $this->connect()->prepare('SELECT * FROM user WHERE IdUser = :IdUser');
        $query->execute(['IdUser' => $IdUser]);
        return $query;
    }
}
?>