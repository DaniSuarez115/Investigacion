<?php
// include_once 'apiauditoria.php';
include_once 'auditoria.php';
class Apiauditoria {
    function getAll() {
        $auditoria = new auditoria();
        $response = array();
        $response["items"] = array();
        $respuesta = $auditoria->getAuditoria();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdAuditoria' => $row['IdAuditoria'],
                    'Sentencia' => $row['Sentencia'],
                    'Controller' => $row['Controller'],
                    'IdMenu' => $row['IdMenu'],
                    'IdUser' => $row['IdUser'],
                    'CreateDate' => $row['CreateDate']
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

    function getById($IdAuditoria) {
        $auditoria = new Auditoria(); // Crear una instancia de la clase auditoria
        $auditoriaItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $auditoria->obtenerAuditoria($IdAuditoria);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdAuditoria' => $row['IdAuditoria'],
                'Sentencia' => $row['Sentencia'],
                'Controller' => $row['Controller'],
                'IdMenu' => $row['IdMenu'],
                'IdUser' => $row['IdUser'],
                'createDate' => $row['createDate']
            );
            array_push($auditoriaItems, $item); // Usar la variable $auditoriaItems en lugar de $auditoria
            $this->printJSON($auditoriaItems);
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