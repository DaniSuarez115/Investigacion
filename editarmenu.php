<?php
// Incluir el archivo de la clase ApiMenu y las dependencias necesarias
include_once 'apimenu.php';

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
    $IdMenu = $segments[1];
    $NameMenu = $segments[2];
    $IdCatalogoMenu = $segments[3];
    $CreatedAt = $segments[4];
    $UpdatedAt = $segments[5];
    $Enabled = $segments[6];

    // Crear una instancia de la clase ApiMenu
    $api = new ApiMenu();

    // Llamar a la función editarMenu con los valores de los parámetros
    $result = $api->editarMenu($IdMenu, $NameMenu, $IdCatalogoMenu, $CreatedAt, $UpdatedAt, $Enabled);

    if ($result) {
        echo 'Los datos del menú se editaron correctamente.';
    } else {
        echo 'Error al editar los datos del menú.';
    }
} else {
    echo 'Faltan parámetros en la URL.';
}
?>