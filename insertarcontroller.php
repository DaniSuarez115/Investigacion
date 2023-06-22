<?php 
include_once 'apicontroller.php';

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
    $IdController = $segments[1];
    $NameControllerView = $segments[2];
    $CreatedAt = $segments[3];
    $UpdatedAt = $segments[4];
    $Enabled = $segments[5];

    // Crear una instancia de la clase ApiControllers
    $api = new ApiController();

    // Llamar a la función insertarController con los valores de los parámetros
    $api->insertarController($IdController, $NameControllerView, $CreatedAt, $UpdatedAt, (bool)$Enabled);

    echo 'Los datos del controlador se insertaron correctamente.';
} else {
    echo 'Faltan parámetros en la URL.';
}

?>    