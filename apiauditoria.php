<?php
// include_once 'apiauditoria.php';
include_once 'auditoria.php';
class Apiauditoria {
    function getAll() {
        $auditoria = new Auditoria();
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
                'CreateDate' => $row['CreateDate']
            );
            array_push($auditoriaItems, $item); // Usar la variable $auditoriaItems en lugar de $auditoria
            $this->printJSON($auditoriaItems);
        } else {
            $this->error('No hay elementos');
        }
    }

    function eliminarById($IdAuditoria) {
        $auditoria = new auditoria(); // Crear una instancia de la clase auditoria
    
        $res = $auditoria->obtenerauditoria($IdAuditoria); // Obtener el menú por IdAuditoria
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
    
            // Obtener los datos del menú
            $IdAuditoria = $row['IdAuditoria'];
            $Sentencia = $row['Sentencia'];
            $Controller = $row['Controller'];
            $IdMenu = $row['IdMenu'];
            $IdUser = $row['IdUser'];
            $CreateDate = $row['CreateDate'];
    
            // Eliminar el menú
            $auditoria->eliminarAuditoria($IdAuditoria);
    
            $item = array(
                'IdAuditoria' => $row['IdAuditoria'],
                'Sentencia' => $row['Sentencia'],
                'Controller' => $row['Controller'],
                'IdMenu' => $row['IdMenu'],
                'IdUser' => $row['IdUser'],
                'CreateDate' => $row['CreateDate']
            );
    
            $this->printJSON($item);
        } else {
            $this->error('no se encontró');
        }
    }

    function insertarAuditoria($IdAuditoria, $Sentencia, $Controller, $IdMenu, $IdUser, $CreateDate)
    {
        $auditoria = new Auditoria(); // Crear una instancia de la clase Auditoria

        // Insertar la auditoría en la base de datos
        $resultado = $auditoria->insertarAuditoria($IdAuditoria, $Sentencia, $Controller, $IdMenu, $IdUser, $CreateDate);

        if ($resultado) {   
            $item = array(
                'IdAuditoria' => $IdAuditoria,
                'Sentencia' => $Sentencia,
                'Controller' => $Controller,
                'IdMenu' => $IdMenu,
                'IdUser' => $IdUser,
                'CreateDate' => $CreateDate
            );

            // Realizar cualquier acción adicional con el resultado de la inserción
        } else {
            $this->error('Error al insertar la auditoría');
        }
    }
    function editarAuditoria($IdAuditoria, $Sentencia, $Controller, $IdMenu, $IdUser, $CreateDate)
{
    $auditoria = new Auditoria(); // Crear una instancia de la clase Auditoria

    // Actualizar la auditoría en la base de datos
    $resultado = $auditoria->editarAuditoria($IdAuditoria, $Sentencia, $Controller, $IdMenu, $IdUser, $CreateDate);

    if ($resultado) {
        $item = array(
            'IdAuditoria' => $IdAuditoria,
            'Sentencia' => $Sentencia,
            'Controller' => $Controller,
            'IdMenu' => $IdMenu,
            'IdUser' => $IdUser,
            'CreateDate' => $CreateDate
        );

        // Realizar cualquier otra acción necesaria con la auditoría actualizada

    } else {
        $this->error('Error al editar la auditoría');
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