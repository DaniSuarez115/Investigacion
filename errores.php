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

    function insertarErrores($IdErrores, $Sentencia, $Controller, $CreatedAt, $IdUser)
    {
        $query = $this->connect()->prepare('INSERT INTO errores (IdErrores, Sentencia, Controller, CreatedAt, IdUser) VALUES (:IdErrores, :Sentencia, :Controller, :CreatedAt, :IdUser)');

        $query->bindParam(':IdErrores', $IdErrores);
        $query->bindParam(':Sentencia', $Sentencia);
        $query->bindParam(':Controller', $Controller);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':IdUser', $IdUser);

        $query->execute();

        return $query;
    }

    function editarErrores($IdErrores, $Sentencia, $Controller, $CreatedAt, $IdUser)
    {
        $query = $this->connect()->prepare('UPDATE errores SET Sentencia = :Sentencia, Controller = :Controller, CreatedAt = :CreatedAt, IdUser = :IdUser WHERE IdErrores = :IdErrores');

        $query->bindParam(':Sentencia', $Sentencia);
        $query->bindParam(':Controller', $Controller);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':IdUser', $IdUser);
        $query->bindParam(':IdErrores', $IdErrores);

        $query->execute();

        return $query;
    }

    public function verificarExistenciaIdErrores($IdErrores) {
        $query = $this->connect()->prepare('SELECT COUNT(*) FROM errores WHERE IdErrores = :IdErrores');
        $query->execute(['IdErrores' => $IdErrores]);

        $count = $query->fetchColumn();

        return ($count > 0);
    }


}
?>