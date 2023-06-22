<?php
include_once 'apiUser.php';
$api = new ApiUser();

if (isset($_GET['IdUser'])) {
    $IdUser = $_GET['IdUser'];

    if (is_numeric($IdUser)) {
        // Llama a la función eliminarById para eliminar el menú por IdUser
        $api->eliminarById($IdUser);
        $api->exito('seteborrotodoGG');
    } else {
        $api->error('no existen datos con el id');
    }
} else {
    $api->getAll();
}
?>