<?php 
include_once 'apiauditoria.php';

// Obtener la URL solicitada
$requestUrl = $_SERVER['REQUEST_URI'];

// Eliminar la parte de la URL base y los parámetros de la solicitud
$baseUrl = '/Investigacion/';
$requestPath = str_replace($baseUrl, '', $requestUrl);

// Dividir la ruta de la URL en segmentos
$segments = explode('/', $requestPath);

// Verificar si se han enviado los suficientes segmentos en la URL
if (count($segments) >= 7) {
    // Obtener los valores de los segmentos
    $IdAuditoria = $segments[1];
    $Sentencia = $segments[2];
    $Controller = $segments[3];
    $IdMenu = $segments[4];
    $IdUser = $segments[5];
    $CreateDate = $segments[6];

    // Crear una instancia de la clase ApiAuditoria
    $api = new ApiAuditoria();

    // Llamar a la función editarAuditoria con los valores de los parámetros
    $api->editarAuditoria($IdAuditoria, $Sentencia, $Controller, $IdMenu, $IdUser, $CreateDate);

    echo 'Los datos de la auditoría se editaron correctamente.';
} else {
    echo 'Faltan parámetros en la URL.';
}
?>
