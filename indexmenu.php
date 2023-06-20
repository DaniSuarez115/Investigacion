<?php
    include_once 'apimenu.php';
    $api = new ApiMenu();

    if(isset($_GET['IdMenu'])){
        $IdMenu = $_GET['IdMenu'];

        if(is_numeric($IdMenu)){
            $api->getById($IdMenu);
        }else{  
            $api->error('El id es incorrecto');
        }
    }else{
        $api->getAll();
    }

?>

<!--  -->