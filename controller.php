<?php
include_once 'db.php';
class Controller extends db
{

    function getController()
    {
        $query = $this->connect()->query('SELECT * FROM controller');
        return $query;
    }
    function obtenerController($IdController){
        $query = $this->connect()->prepare('SELECT * FROM controller WHERE IdController = :IdController');
        $query->execute(['IdController' => $IdController]);
        return $query;
    }

    function insertarController($IdController, $NameControllerView, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $query = $this->connect()->prepare('INSERT INTO controller (IdController, NameControllerView, CreatedAt, UpdatedAt, Enabled) VALUES (:IdController, :NameControllerView, :CreatedAt, :UpdatedAt, :Enabled)');

        // Convertir el valor de Enabled a un entero
        $enabledValue = ($Enabled) ? 1 : 0;

        $query->bindParam(':IdController', $IdController);
        $query->bindParam(':NameControllerView', $NameControllerView);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':UpdatedAt', $UpdatedAt);
        $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);

        $query->execute();

        return $query;
    }

    public function editarController($IdController, $NameControllerView, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $query = $this->connect()->prepare('UPDATE controller SET NameControllerView = :NameControllerView, CreatedAt = :CreatedAt, UpdatedAt = :UpdatedAt, Enabled = :Enabled WHERE IdController = :IdController');

        // Convertir el valor de Enabled a un entero
        $enabledValue = ($Enabled) ? 1 : 0;

        $query->bindParam(':IdController', $IdController);
        $query->bindParam(':NameControllerView', $NameControllerView);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':UpdatedAt', $UpdatedAt);
        $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);

        $query->execute();

        return $query;
    }







}?>