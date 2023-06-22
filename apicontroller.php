<?php
include_once 'apicontroller.php';
include_once 'controller.php';
class ApiController {
    function getAll() {
        $controller = new Controller();
        $response = array();
        $response["items"] = array();
        $respuesta = $controller->getController();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdController' => $row['IdController'],
                    'NameControllerView' => $row['NameControllerView'],
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

    function getById($Idcontroller) {
        $controller = new Controller(); // Crear una instancia de la clase controller
        $controllerItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $controller->obtenerController($Idcontroller);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdController' => $row['IdController'],
                'NameControllerView' => $row['NameControllerView'],
                'CreatedAt' => $row['CreatedAt'],
                'UpdatedAt' => $row['UpdatedAt'],
                'Enabled' => $row['Enabled']
            );
            array_push($controllerItems, $item); // Usar la variable $controllerItems en lugar de $controller
            $this->printJSON($controllerItems);
        } else {
            $this->error('No hay elementos');
        }
    }

    function eliminarById($IdController) {
        $controller = new controller(); // Crear una instancia de la clase controller
    
        $res = $controller->obtenercontroller($IdController); // Obtener el menú por IdController
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
    
            // Obtener los datos del menú
            $IdController = $row['IdController'];
            $NameControllerView = $row['NameControllerView'];
            $CreatedAt = $row['CreatedAt'];
            $UpdatedAt = $row['UpdatedAt'];
            $Enabled = $row['Enabled'];

            $controller->eliminarcontroller($IdController);
    
            $item = array(
                'IdController' => $row['IdController'],
                'NameControllerView' => $row['NameControllerView'],
                'CreatedAt' => $row['CreatedAt'],
                'UpdatedAt' => $row['UpdatedAt'],
                'Enabled' => $row['Enabled']
            );
    
            $this->printJSON($item);
        } else {
            $this->error('no se encontró');
        }
    }

    function insertarController($IdController, $NameControllerView, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $controller = new Controller(); // Crear una instancia de la clase Controller

        // Insertar el registro en la base de datos
        $resultado = $controller->insertarController($IdController, $NameControllerView, $CreatedAt, $UpdatedAt, $Enabled);

        if ($resultado) {
            $item = array(
                'IdController' => $IdController,
                'NameControllerView' => $NameControllerView,
                'CreatedAt' => $CreatedAt,
                'UpdatedAt' => $UpdatedAt,
                'Enabled' => $Enabled
            );

            // Realizar cualquier acción adicional con el resultado de la inserción
        } else {
            $this->error('Error al insertar el controller');
        }
    }

    function editarController($IdController, $NameControllerView, $CreatedAt, $UpdatedAt, $Enabled)
    {
        $controller = new Controller(); // Crear una instancia de la clase Controller

        // Actualizar el registro en la base de datos
        $resultado = $controller->editarController($IdController, $NameControllerView, $CreatedAt, $UpdatedAt, $Enabled);

        if ($resultado) {
            $item = array(
                'IdController' => $IdController,
                'NameControllerView' => $NameControllerView,
                'CreatedAt' => $CreatedAt,
                'UpdatedAt' => $UpdatedAt,
                'Enabled' => $Enabled
            );

            // Realizar cualquier acción adicional con el resultado de la actualización
        } else {
            $this->error('Error al editar el controller');
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