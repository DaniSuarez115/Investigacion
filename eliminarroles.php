<?php
include_once 'apiroles.php';
$api = new apiRoles();

if (isset($_GET['IdRoles'])) {
    $IdRoles = $_GET['IdRoles'];

    if (is_numeric($IdRoles)) {
        // Llama a la función eliminarById para eliminar el menú por IdRoles
        $api->eliminarById($IdRoles);
        $api->exito('seteborrotodoGG');
    } else {
        $api->error('no existen datos con el id');
    }
} else {
    $api->getAll();
}
?>