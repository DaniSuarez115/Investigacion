<?php
include_once 'db.php';
class Menu extends db
{
    function getMenu()
    {
        $query = $this->connect()->query('SELECT * FROM menu');
        return $query;
    }

    function obtenerMenu($IdMenu){
        $query = $this->connect()->prepare('SELECT * FROM menu WHERE IdMenu = :IdMenu');
        $query->execute(['IdMenu' => $IdMenu]);
        return $query;
    }

    function eliminarMenu($IdMenu){
        $query = $this->connect()->prepare('DELETE FROM menu WHERE IdMenu = :IdMenu');
        $query->execute(['IdMenu' => $IdMenu]);
        return $query;
    }

    function insertarMenu($IdMenu, $NameMenu, $IdCatalogoMenu, $CreatedAt, $UpdatedAt, $Enabled) {
        $query = $this->connect()->prepare('INSERT INTO menu (IdMenu, NameMenu, IdCatalogoMenu, CreatedAt, UpdatedAt, Enabled) VALUES (:IdMenu, :NameMenu, :IdCatalogoMenu, :CreatedAt, :UpdatedAt, :Enabled)');
        $query->execute([
            'IdMenu' => $IdMenu,
            'NameMenu' => $NameMenu,
            'IdCatalogoMenu' => $IdCatalogoMenu,
            'CreatedAt' => $CreatedAt,
            'UpdatedAt' => $UpdatedAt,
            'Enabled' => $Enabled
        ]);
        return $query;
    }

}


?>