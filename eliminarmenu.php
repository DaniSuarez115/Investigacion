<?php
include_once 'apimenu.php';
$api = new ApiMenu();

if (isset($_GET['IdMenu'])) {
    $IdMenu = $_GET['IdMenu'];

    if (is_numeric($IdMenu)) {
        // Llama a la función eliminarById para eliminar el menú por IdMenu
        $api->eliminarById($IdMenu);
        $api->exito('seteborrotodoGG');
    } else {
        $api->error('no existen datos con el id');
    }
} else {
    $api->getAll();
}
?>