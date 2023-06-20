<?php
include_once 'db.php';
class Auditoria extends db
{

    function getAuditoria()
    {
        $query = $this->connect()->query('SELECT * FROM auditoria');
        return $query;
    }
}


?>