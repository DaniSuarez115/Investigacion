<?php
include_once 'apiauditoria.php';
$api = new ApiAuditoria();

if (isset($_GET['IdAuditoria'])) {
    $IdAuditoria = $_GET['IdAuditoria'];

    if (is_numeric($IdAuditoria)) {
        // Llama a la función eliminarById para eliminar el menú por IdAuditoria
        $api->eliminarById($IdAuditoria);
        $api->exito('seteborrotodoGG');
    } else {
        $api->error('no existen datos con el id');
    }
} else {
    $api->getAll();
}
?>