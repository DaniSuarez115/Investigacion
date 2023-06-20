<?php
    include_once 'apierrores.php';
    $api = new apiErrores();

    if(isset($_GET['IdErrores'])){
        $IdErrores = $_GET['IdErrores'];

        if(is_numeric($IdErrores)){
            $api->getById($IdErrores);
        }else{  
            $api->error('El id es incorrecto');
        }
    }else{
        $api->getAll();
    }
?>