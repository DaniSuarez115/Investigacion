
<?php
$servidor = "localhost";
$nombreusuario = "root";  
$password = "123";
$conexion = new mysqli($servidor, $nombreusuario,$password);

if($conexion-> connect_error){
    	die("Conexion fallida: ".$conexion-> connect_error);
}
?>