<?php
include_once 'apierrores.php';

// Obtener la URL solicitada
$requestUrl = $_SERVER['REQUEST_URI'];

// Eliminar la parte de la URL base y los parámetros de la solicitud
$baseUrl = '/Investigacion/';
$requestPath = str_replace($baseUrl, '', $requestUrl);

// Dividir la ruta de la URL en segmentos
$segments = explode('/', $requestPath);

// Verificar si se han enviado los suficientes segmentos en la URL
if (count($segments) >= 5) {
    // Obtener los valores de los segmentos
    $IdErrores = $segments[1];
    $Sentencia = $segments[2];
    $Controller = $segments[3];
    $CreatedAt = $segments[4];
    $IdUser = $segments[5];

    // Crear una instancia de la clase ApiErrores
    $api = new ApiErrores();

    // Llamar a la función editarErrores con los valores de los parámetros
    $api->editarErrores($IdErrores, $Sentencia, $Controller, $CreatedAt, $IdUser);

    echo 'Los datos del error se editaron correctamente.';
} else {
    echo 'Faltan parámetros en la URL.';
}
?>