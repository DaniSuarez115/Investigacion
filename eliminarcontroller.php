<?php
include_once 'apicontroller.php';
$api = new ApiController();

if (isset($_GET['IdController'])) {
    $IdController = $_GET['IdController'];

    if (is_numeric($IdController)) {
        // Llama a la función eliminarById para eliminar el menú por IdController
        $api->eliminarById($IdController);
        $api->exito('Borrado');
    } else {
        $api->error('no existen datos con el id');
    }
} else {
    $api->getAll();
}
?>