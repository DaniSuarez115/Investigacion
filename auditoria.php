<?php
include_once 'db.php';
class Auditoria extends db
{

    function getAuditoria()
    {
        $query = $this->connect()->query('SELECT * FROM auditoria');
        return $query;
    }
    function obtenerAuditoria($IdAuditoria){
        $query = $this->connect()->prepare('SELECT * FROM auditoria WHERE IdAuditoria = :IdAuditoria');
        $query->execute(['IdAuditoria' => $IdAuditoria]);
        return $query;
    }

    function insertarAuditoria($IdAuditoria, $Sentencia, $Controller, $IdMenu, $IdUser, $CreateDate)
    {
        $query = $this->connect()->prepare('INSERT INTO auditoria (IdAuditoria, Sentencia, Controller, IdMenu, IdUser, CreateDate) VALUES (:IdAuditoria, :Sentencia, :Controller, :IdMenu, :IdUser, :CreateDate)');

        $query->bindParam(':IdAuditoria', $IdAuditoria);
        $query->bindParam(':Sentencia', $Sentencia);
        $query->bindParam(':Controller', $Controller);
        $query->bindParam(':IdMenu', $IdMenu);
        $query->bindParam(':IdUser', $IdUser);
        $query->bindParam(':CreateDate', $CreateDate);

        $query->execute();

        return $query;
    }

    function editarAuditoria($IdAuditoria, $Sentencia, $Controller, $IdMenu, $IdUser, $CreateDate)
    {
        $query = $this->connect()->prepare('UPDATE auditoria SET Sentencia = :Sentencia, Controller = :Controller, IdMenu = :IdMenu, IdUser = :IdUser, CreateDate = :CreateDate WHERE IdAuditoria = :IdAuditoria');

        $query->bindParam(':IdAuditoria', $IdAuditoria);
        $query->bindParam(':Sentencia', $Sentencia);
        $query->bindParam(':Controller', $Controller);
        $query->bindParam(':IdMenu', $IdMenu);
        $query->bindParam(':IdUser', $IdUser);
        $query->bindParam(':CreateDate', $CreateDate);

        $query->execute();

        return $query;
    }
}


?>