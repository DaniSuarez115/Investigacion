<?php
    include_once 'apicontroller.php';
    $api = new Apicontroller();

    if(isset($_GET['IdController'])){
        $IdController = $_GET['IdController'];

        if(is_numeric($IdController)){
            $api->getById($IdController);
        }else{  
            $api->error('El id es incorrecto');
        }
    }else{
        $api->getAll();
    }
    


?>