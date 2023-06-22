<?php
// Incluir el archivo de la clase ApiRoles y las dependencias necesarias
include_once 'apiroles.php';

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
    $IdRol = $segments[1];
    $NameRol = $segments[2];
    $IdMenu = $segments[3];
    $CreatedAt = $segments[4];
    $UpdatedAt = $segments[5];
    $Enabled = $segments[6];

    // Crear una instancia de la clase ApiRoles
    $api = new ApiRoles();

    // Llamar a la función editarRol con los valores de los parámetros
    $api->editarRol($IdRol, $NameRol, $IdMenu, $CreatedAt, $UpdatedAt, (bool)$Enabled);

    echo 'Los datos del rol se editaron correctamente.';
} else {
    echo 'Faltan parámetros en la URL.';
}
?>