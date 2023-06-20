<?php
include_once 'apiroles.php';
include_once 'roles.php';

// // Crear una instancia de ApiRoles
// $apiRoles = new ApiRoles();

// // Llamar al método getAll() para obtener los datos
// $apiRoles->getAll();

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
                    'IdRol' => $row['IdRol'],
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
    function getById($IdRol) {
        $roles = new Roles(); // Crear una instancia de la clase roles
        $rolItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $roles->obtenerRol($IdRol);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdRol' => $row['IdRol'],
                'NameRol' => $row['NameRol'],
                'IdRol' => $row['IdRol'],
                'CreatedAt' => $row['CreatedAt'],
                'UpdatedAt' => $row['UpdatedAt'],
                'Enabled' => $row['Enabled']
            );
            array_push($rolItems, $item); // Usar la variable $roltems en lugar de $rol
            $this->printJSON($rolItems);
        } else {
            $this->error('No hay elementos');
        }
    }

    function error($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function printJSON($array){
        echo '<code>'.json_encode($array).'</code>';
    }
    function exito($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }
}
?>

