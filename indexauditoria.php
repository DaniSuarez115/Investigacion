<?php
      include_once 'apiauditoria.php';
      $api = new ApiAuditoria();
  
      if(isset($_GET['IdAuditoria'])){
          $IdAuditoria = $_GET['IdAuditoria'];
  
          if(is_numeric($IdAuditoria)){
              $api->getById($IdAuditoria);
          }else{  
              $api->error('El id es incorrecto');
          }
      }else{
          $api->getAll();
      }
?>