<?php
// Incluir el archivo de la clase ApiUser y las dependencias necesarias
include_once 'apiuser.php';

// Obtener la URL solicitada
$requestUrl = $_SERVER['REQUEST_URI'];

// Eliminar la parte de la URL base y los parámetros de la solicitud
$baseUrl = '/Investigacion/';
$requestPath = str_replace($baseUrl, '', $requestUrl);

// Dividir la ruta de la URL en segmentos
$segments = explode('/', $requestPath);

// Verificar si se han enviado los suficientes segmentos en la URL
if (count($segments) >= 11) {
    // Obtener los valores de los segmentos
    $IdUser = $segments[1];
    $ldPersonal = $segments[2];
    $NameUser = $segments[3];
    $LastName = $segments[4];
    $Email = $segments[5];
    $UserName = $segments[6];
    $Password = $segments[7];
    $IdRol = $segments[8];
    $CreatedAt = $segments[9];
    $Enabled = $segments[10];
    $UpdatedAt = $segments[11];

    // Crear una instancia de la clase ApiUser
    $api = new ApiUser();
    
    // Llamar a la función insertarUser con los valores de los parámetros
    $api->insertarUser($IdUser, $ldPersonal, $NameUser, $LastName, $Email, $UserName, $Password, $IdRol, $CreatedAt, $Enabled, $UpdatedAt);

    echo 'Los datos del usuario se insertaron correctamente.';
} else {
    echo 'Faltan parámetros en la URL.';
}
?>