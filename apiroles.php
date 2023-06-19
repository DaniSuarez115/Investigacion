<?php
include_once 'roles.php';
class ApiRoles{
    function getAll()
    {
        $rol=new Roles();
        $rol=array();
        $rol[""]=array();
        $respuesta=$rol->obtenerRoles();
        if ($respuesta->rowCount())
        {
            while ($row=$respuesta->fetch(PDO::FETCH_ASSOC))
            {
             $item=array(
                'id'=>$row['id']
             );
             array_push($rol['items'],$items);
            }
        }else echo json_encode('mesaje'=>'No hay elementos');
    }
}

?>