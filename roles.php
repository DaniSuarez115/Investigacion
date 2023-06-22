<?php
include_once 'db.php';
class Roles extends db
{

    function getRoles()
    {
        $query = $this->connect()->query('SELECT * FROM roles');
        return $query;

    }

    function obtenerRol($IdRol){
        $query = $this->connect()->prepare('SELECT * FROM roles WHERE IdRol = :IdRol');
        $query->execute(['IdRol' => $IdRol]);
        return $query;
    }

    function insertarRol($IdRol, $NameRol, $IdMenu, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $query = $this->connect()->prepare('INSERT INTO roles (IdRol, NameRol, IdMenu, CreatedAt, UpdatedAt, Enabled) VALUES (:IdRol, :NameRol, :IdMenu, :CreatedAt, :UpdatedAt, :Enabled)');

        // Convertir el valor de Enabled a un entero
        $enabledValue = ($Enabled) ? 1 : 0;

        $query->bindParam(':IdRol', $IdRol);
        $query->bindParam(':NameRol', $NameRol);
        $query->bindParam(':IdMenu', $IdMenu);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':UpdatedAt', $UpdatedAt);
        $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);

        $query->execute();

        return $query;
    }

    function editarRol($IdRol, $NameRol, $IdMenu, $CreatedAt, $UpdatedAt, $Enabled)
{
    $query = $this->connect()->prepare('UPDATE roles SET NameRol = :NameRol, IdMenu = :IdMenu, CreatedAt = :CreatedAt, UpdatedAt = :UpdatedAt, Enabled = :Enabled WHERE IdRol = :IdRol');

    // Convertir el valor de Enabled a un entero
    $enabledValue = ($Enabled) ? 1 : 0;

    $query->bindParam(':IdRol', $IdRol);
    $query->bindParam(':NameRol', $NameRol);
    $query->bindParam(':IdMenu', $IdMenu);
    $query->bindParam(':CreatedAt', $CreatedAt);
    $query->bindParam(':UpdatedAt', $UpdatedAt);
    $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);

    $query->execute();

    return $query;
}
}


?>