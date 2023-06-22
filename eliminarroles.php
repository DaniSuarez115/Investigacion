<?php
include_once 'apiroles.php';
$api = new ApiRoles();

if (isset($_GET['IdRol'])) {
    $IdRol = $_GET['IdRol'];

    if (is_numeric($IdRol)) {
        // Llama a la función eliminarById para eliminar el menú por IdMenu
        $api->eliminarById($IdRol);
        $api->exito('Borrado correctamente');
    } else {
        $api->error('no existen datos con el id');
    }
} else {
    $api->getAll();
}
?>