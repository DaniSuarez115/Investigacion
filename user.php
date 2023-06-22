<?php
include_once 'db.php';
class User extends db
{
    function getUser()
    {
        $query = $this->connect()->query('SELECT * FROM user');
        return $query;
    }
    function obtenerUser($IdUser){
        $query = $this->connect()->prepare('SELECT * FROM user WHERE IdUser = :IdUser');
        $query->execute(['IdUser' => $IdUser]);
        return $query;
    }

    function eliminarUser($IdUser){
        $query = $this->connect()->prepare('DELETE FROM user WHERE IdUser = :IdUser');
        $query->execute(['IdUser' => $IdUser]);
        return $query;
    }

    function insertarUser($IdUser, $IdPersonal, $NameUser, $LastName, $Email, $UserName, $Password, $IdRol, $CreatedAt, $Enabled, $UpdateAt)
    {
        $query = $this->connect()->prepare('INSERT INTO user (IdUser, IdPersonal, NameUser, LastName, Email, UserName, Password, IdRol, CreatedAt, Enabled, UpdateAt) VALUES (:IdUser, :IdPersonal, :NameUser, :LastName, :Email, :UserName, :Password, :IdRol, :CreatedAt, :Enabled, :UpdateAt)');
    
        // Convertir el valor de Enabled a un entero
        $enabledValue = ($Enabled) ? 1 : 0;
    
        $query->bindParam(':IdUser', $IdUser);
        $query->bindParam(':IdPersonal', $IdPersonal);
        $query->bindParam(':NameUser', $NameUser);
        $query->bindParam(':LastName', $LastName);
        $query->bindParam(':Email', $Email);
        $query->bindParam(':UserName', $UserName);
        $query->bindParam(':Password', $Password);
        $query->bindParam(':IdRol', $IdRol);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);
        $query->bindParam(':UpdateAt', $UpdateAt);
    
        $query->execute();
    
        return $query;
    }

    function editarUser($IdUser, $IdPersonal, $NameUser, $LastName, $Email, $UserName, $Password, $IdRol, $CreatedAt, $Enabled, $UpdateAt)
    {
        $query = $this->connect()->prepare('UPDATE user SET IdPersonal = :IdPersonal, NameUser = :NameUser, LastName = :LastName, Email = :Email, UserName = :UserName, Password = :Password, IdRol = :IdRol, CreatedAt = :CreatedAt, Enabled = :Enabled, UpdateAt = :UpdateAt WHERE IdUser = :IdUser');

        // Convertir el valor de Enabled a un entero
        $enabledValue = ($Enabled) ? 1 : 0;

        $query->bindParam(':IdUser', $IdUser);
        $query->bindParam(':IdPersonal', $IdPersonal);
        $query->bindParam(':NameUser', $NameUser);
        $query->bindParam(':LastName', $LastName);
        $query->bindParam(':Email', $Email);
        $query->bindParam(':UserName', $UserName);
        $query->bindParam(':Password', $Password);
        $query->bindParam(':IdRol', $IdRol);
        $query->bindParam(':CreatedAt', $CreatedAt);
        $query->bindParam(':Enabled', $enabledValue, PDO::PARAM_INT);
        $query->bindParam(':UpdateAt', $UpdateAt);

        $query->execute();

        return $query;
    }   

}
?>