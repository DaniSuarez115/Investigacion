<?php
include_once 'roles.php';
include_once 'db.php';
class ApiRoles{
    function getAll()
    {
        $rol=new Roles();
        $rol=array();
        $rol["items"]=array();
        $respuesta=$rol->obtenerRoles();
        if ($respuesta->rowCount())
        {
            while ($row=$respuesta->fetch(PDO::FETCH_ASSOC))
            {
             $item=array(
                'idRol'=>$row['idRol']
             );
             array_push($rol['items'],$items);
            }
            

        }
        else 
        {
            // echo json_encode('mesaje'->'No hay elementos');
        }
    }
}

?>