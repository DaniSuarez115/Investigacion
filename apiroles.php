<?php
include_once 'apiroles.php';
include_once 'roles.php';

// Crear una instancia de ApiRoles
$apiRoles = new ApiRoles();

// Llamar al método getAll() para obtener los datos
$apiRoles->getAll();

class ApiRoles {
    function getAll() {
        $roles = new Roles();
        $response = array();
        $response["items"] = array();
        $respuesta = $roles->getRoles();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdRol' => $row['IdRol'],
                    'NameRol' => $row['NameRol'],
                    'IdMenu' => $row['IdMenu'],
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

