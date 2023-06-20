<?php
// Incluir el archivo de la clase ApiMenu y las dependencias necesarias
include_once 'apimenu.php';

// Verificar si se han enviado los parámetros en la URL
if (isset($_GET['IdMenu'], $_GET['NameMenu'], $_GET['IdCatalogoMenu'], $_GET['CreatedAt'], $_GET['UpdatedAt'], $_GET['Enabled'])) {
    // Obtener los valores de los parámetros
    $IdMenu = $_GET['IdMenu'];
    $NameMenu = $_GET['NameMenu'];
    $IdCatalogoMenu = $_GET['IdCatalogoMenu'];
    $CreatedAt = $_GET['CreatedAt'];
    $UpdatedAt = $_GET['UpdatedAt'];
    $Enabled = $_GET['Enabled'];

    // Crear una instancia de la clase ApiMenu
    $api = new ApiMenu();

    // Llamar a la función insertarMenu con los valores de los parámetros
    $result = $api->insertarMenu($IdMenu, $NameMenu, $IdCatalogoMenu, $CreatedAt, $UpdatedAt, $Enabled);

    if ($result) {
        echo 'Los datos del menú se insertaron correctamente.';
    } else {
        echo 'Error al insertar los datos del menú.';
    }
} else {
    echo 'Faltan parámetros en la URL.';
}
?>
 