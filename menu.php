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
    
    function insertarMenu($IdMenu, $NameMenu, $IdCatalogoMenu, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $query = $this->connect()->prepare('INSERT INTO menu (IdMenu, NameMenu, IdCatalogoMenu, CreatedAt, UpdatedAt, Enabled) VALUES (:IdMenu, :NameMenu, :IdCatalogoMenu, :CreatedAt, :UpdatedAt, :Enabled)');
        
        // Convertir el valor de Enabled a un entero
        $enabledValue = ($Enabled) ? 1 : 0;
    
        $query->bindParam(':IdMenu', $IdMenu);
        $query->bindParam(':NameMenu', $NameMenu);
        $query->bindParam(':IdCatalogoMenu', $IdCatalogoMenu);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':UpdatedAt', $UpdatedAt);
        $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);
    
        $query->execute();
    
        return $query;
    }

    function editarMenu($IdMenu, $NameMenu, $IdCatalogoMenu, $CreatedAt, $UpdatedAt, $Enabled) {
        $query = $this->connect()->prepare('UPDATE menu SET NameMenu = :NameMenu, IdCatalogoMenu = :IdCatalogoMenu, CreatedAt = :CreatedAt, UpdatedAt = :UpdatedAt, Enabled = :Enabled WHERE IdMenu = :IdMenu');
        $query->bindParam(':IdMenu', $IdMenu);
        $query->bindParam(':NameMenu', $NameMenu);
        $query->bindParam(':IdCatalogoMenu', $IdCatalogoMenu);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':UpdatedAt', $UpdatedAt);
        
        // Convertir el valor de Enabled a un entero
        $enabledValue = ($Enabled) ? 1 : 0;
        $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);

        $query->execute();

        return $query;
    }
}
?>

