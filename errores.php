<?php
include_once 'db.php';
class Errores extends db
{
    function getErrores()
    {
        $query = $this->connect()->query('SELECT * FROM errores');
        return $query;
    }
    
    function obtenerErrores($IdErrores){
        $query = $this->connect()->prepare('SELECT * FROM errores WHERE IdErrores = :IdErrores');
        $query->execute(['IdErrores' => $IdErrores]);
        return $query;
    }
}
?>