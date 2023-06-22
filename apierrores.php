<?php
// include_once 'apierror.php';
include_once 'errores.php';

class ApiErrores {
    function getAll() {
        $error = new Errores();
        $response = array();
        $response["items"] = array();
        $respuesta = $error->getErrores();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdErrores' => $row['IdErrores'],
                    'Sentencia' => $row['Sentencia'],
                    'Controller' => $row['Controller'],
                    'CreatedAt' => $row['CreatedAt'],
                    'IdUser' => $row['IdUser']
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
    function getById($IdErrores) {
        $errores = new errores(); // Crear una instancia de la clase errores
        $erroresItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $errores->obtenerErrores($IdErrores);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdErrores' => $row['IdErrores'],
                    'Sentencia' => $row['Sentencia'],
                    'Controller' => $row['Controller'],
                    'CreatedAt' => $row['CreatedAt'],
                    'IdUser' => $row['IdUser']
            );
            array_push($erroresItems, $item); // Usar la variable $erroresItems en lugar de $errores
            $this->printJSON($erroresItems);
        } else {
            $this->error('No hay elementos');
        }
    }

    function eliminarById($IdErrores) {
        $error = new Errores(); // Crear una instancia de la clase error
    
        $res = $error->obtenErerrores($IdErrores); // Obtener el menú por IdErrores
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
    
            // Obtener los datos del menú
            $IdErrores = $row['IdErrores'];
            $Sentencia = $row['Sentencia'];
            $Controller = $row['Controller'];
            $CreatedAt = $row['CreatedAt'];
            $IdUser = $row['IdUser'];
    
            // Eliminar el menú
            $error->eliminarError($IdErrores);
    
            $item = array(
                'IdErrores' => $row['IdErrores'],
                'Sentencia' => $row['Sentencia'],
                'Controller' => $row['Controller'],
                'CreatedAt' => $row['CreatedAt'],
                'IdUser' => $row['IdUser']
            );
    
            $this->printJSON($item);
        } else {
            $this->error('no se encontró');
        }
    }


    function insertarErrores($IdErrores, $Sentencia, $Controller, $CreatedAt, $IdUser)
    {
        $errores = new Errores(); // Crear una instancia de la clase Errores

        // Insertar los datos de errores en la base de datos
        $resultado = $errores->insertarErrores($IdErrores, $Sentencia, $Controller, $CreatedAt, $IdUser);

        if ($resultado) {   
            $item = array(
                'IdErrores' => $IdErrores,
                'Sentencia' => $Sentencia,
                'Controller' => $Controller,
                'CreatedAt' => $CreatedAt,
                'IdUser' => $IdUser
            );

            // Realizar cualquier acción adicional con el resultado de la inserción
        } else {
            $this->error('Error al insertar los errores');
        }
    }

    function editarErrores($IdErrores, $Sentencia, $Controller, $CreatedAt, $IdUser)
    {
        $errores = new Errores(); // Crear una instancia de la clase Errores
    
        // Verificar la existencia del IdErrores
        if (!$errores->verificarExistenciaIdErrores($IdErrores)) {
            $this->error('El IdErrores no existe');
            return;
        }
    
        // Actualizar los datos de errores en la base de datos
        $resultado = $errores->editarErrores($IdErrores, $Sentencia, $Controller, $CreatedAt, $IdUser);
    
        if ($resultado) {   
            $item = array(
                'IdErrores' => $IdErrores,
                'Sentencia' => $Sentencia,
                'Controller' => $Controller,
                'CreatedAt' => $CreatedAt,
                'IdUser' => $IdUser
            );
    
            // Realizar cualquier acción adicional con el resultado de la actualización
        } else {
            $this->error('Error al editar los errores');
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