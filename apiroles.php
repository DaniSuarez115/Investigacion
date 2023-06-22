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
    function getById($IdRol) {
        $roles = new Roles(); // Crear una instancia de la clase roles
        $rolItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $roles->obtenerRol($IdRol);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdRol' => $row['IdRol'],
                'NameRol' => $row['NameRol'],
                'IdMenu' => $row['IdMenu'],
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
    

    function insertarRol($IdRol, $NameRol, $IdMenu, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $rol = new Roles(); // Crear una instancia de la clase Rol

        // Insertar el rol en la base de datos
        $resultado = $rol->insertarRol($IdRol, $NameRol, $IdMenu, $CreatedAt, $UpdatedAt, $Enabled);

        if ($resultado) {   
            $item = array(
                'IdRol' => $IdRol,
                'NameRol' => $NameRol,
                'IdMenu' => $IdMenu,
                'CreatedAt' => $CreatedAt,
                'UpdatedAt' => $UpdatedAt,
                'Enabled' => $Enabled
            );

            
        } else {
            $this->error('Error al insertar el rol');
        }
    }

    function editarRol($IdRol, $NameRol, $IdMenu, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $rol = new Roles(); // Crear una instancia de la clase Roles

        // Actualizar el rol en la base de datos
        $resultado = $rol->editarRol($IdRol, $NameRol, $IdMenu, $CreatedAt, $UpdatedAt, $Enabled);

        if ($resultado) {   
            $item = array(
                'IdRol' => $IdRol,
                'NameRol' => $NameRol,
                'IdMenu' => $IdMenu,
                'CreatedAt' => $CreatedAt,
                'UpdatedAt' => $UpdatedAt,
                'Enabled' => $Enabled
            );

            // Realizar cualquier otra acción necesaria con el rol actualizado
            
        } else {
            $this->error('Error al editar el rol');
        }
    }

    function eliminarById($IdRol) {
        $rol = new Roles(); // Crear una instancia de la clase rol
    
        $res = $rol->obtenerRol($IdRol); // Obtener el menú por IdRol
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
    
            // Obtener los datos del menú
            $IdRol = $row['IdRol'];
            $NameRol = $row['NameRol'];
            $IdMenu = $row['IdMenu'];
            $CreatedAt = $row['CreatedAt'];
            $UpdatedAt = $row['UpdatedAt'];
            $Enabled = $row['Enabled'];
    
            // Eliminar el menú
            $rol->eliminarRol($IdRol);
    
            $item = array(
                'IdRol' => $row['IdRol'],
                'NameRol' => $row['NameRol'],
                'IdMenu' => $row['IdMenu'],
                'CreatedAt' => $row['CreatedAt'],
                'UpdatedAt' => $row['UpdatedAt'],
                'Enabled' => $row['Enabled']
            );
    
            $this->printJSON($item);
        } else {
            $this->error('no se encontró');
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

