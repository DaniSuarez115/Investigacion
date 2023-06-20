<?php
include_once 'db.php';
class Errores extends db
{
    function getErrores()
    {
        $query = $this->connect()->query('SELECT * FROM errores');
        return $query;
    }
}
?>