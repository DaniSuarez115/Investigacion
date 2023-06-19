<?php
include_once 'apimenu.php';
include_once 'menu.php';

// Crear una instancia de ApiRoles
$apiMenu = new ApiMenu();

// Llamar al método getAll() para obtener los datos
$apiMenu->getAll();

class ApiMenu {
    function getAll() {
        $menu = new Menu();
        $response = array();
        $response["items"] = array();
        $respuesta = $menu->getMenu();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdMenu' => $row['IdMenu'],
                    'NameMenu' => $row['NameMenu'],
                    'IdCatalogoMenu' => $row['IdCatalogoMenu'],
                    'CreatedAt' => $row['CreatedAt'],
                    'UpdatedAt' => $row['UpdatedAt'],
                    'Enabled' => $row['Enabled']
                );
                array_push($response['items'], $item);
            }
            // Codificar el arreglo $response en JSON y mostrarlo
            echo json_encode($response);
        } else {
            // No hay elementos, mostrar mensaje en JSON
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }
}
?>