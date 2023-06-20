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
}


?>