<?php
include_once 'apierrores.php';
$api = new ApiErrores();

if (isset($_GET['IdErrores'])) {
    $IdErrores = $_GET['IdErrores'];

    if (is_numeric($IdErrores)) {
        // Llama a la función eliminarById para eliminar el menú por IdMenu
        $api->eliminarById($IdErrores);
        $api->exito('Borrado');
    } else {
        $api->error('no existen datos con el id');
    }
} else {
    $api->getAll();
}
?>