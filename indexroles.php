<?php
    include_once 'apiroles.php';
    $api = new ApiRoles();

    if(isset($_GET['IdRol'])){
        $IdRol = $_GET['IdRol'];

        if(is_numeric($IdRol)){
            $api->getById($IdRol);
        }else{  
            $api->error('El id es incorrecto');
        }
    }else{
        $api->getAll();
    }
    


?>