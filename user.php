<?php
include_once 'db.php';
class User extends db
{
    function getUser()
    {
        $query = $this->connect()->query('SELECT * FROM user');
        return $query;
    }
}
?>