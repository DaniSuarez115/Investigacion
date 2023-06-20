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

    function getById($Iderror) {
        $error = new error(); // Crear una instancia de la clase error
        $errorItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $error->obtenererror($Iderror);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'Iderror' => $row['Iderror'],
                'Nameerror' => $row['Nameerror'],
                'IdCatalogoerror' => $row['IdCatalogoerror'],
                'CreatedAt' => $row['CreatedAt'],
                'UpdatedAt' => $row['UpdatedAt'],
                'Enabled' => $row['Enabled']
            );
            array_push($errorItems, $item); // Usar la variable $errorItems en lugar de $error
            $this->printJSON($errorItems);
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