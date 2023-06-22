<?php
       include_once 'apiuser.php';
       $api = new ApiUser();
   
       if(isset($_GET['IdUser'])){
           $IdUser = $_GET['IdUser'];
   
           if(is_numeric($IdUser)){
               $api->getById($IdUser);
           }else{  
               $api->error('El id es incorrecto');
           }
       }else{
           $api->getAll();
       }
?>