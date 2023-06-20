<?php
include_once 'apiuser.php';
include_once 'user.php';
class Apiuser {
    function getAll() {
        $user = new User();
        $response = array();
        $response["items"] = array();
        $respuesta = $user->getUser();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdUser' => $row['IdUser'],
                    'ldPersonal' => $row['ldPersonal'],
                    'Nameuser' => $row['Nameuser'],
                    'LastName' => $row['LastName'],
                    'Email' => $row['Email'],
                    'UserName' => $row['UserName'],
                    'Password' => $row['Password'],
                    'IdRol' => $row['Enabled'],
                    'CreatedAt' => $row['CreatedAt'],
                    'Enabled' => $row['Enabled'],
                    'UpdatedAt' => $row['UpdatedAt']
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
    function getById($IdUser) {
        $user = new User(); // Crear una instancia de la clase User
        $userItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $menu->obtenerMenu($IdUser);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdUser' => $row['IdUser'],
                'ldPersonal' => $row['ldPersonal'],
                'Nameuser' => $row['Nameuser'],
                'LastName' => $row['LastName'],
                'Email' => $row['Email'],
                'UserName' => $row['UserName'],
                'Password' => $row['Password'],
                'IdRol' => $row['Enabled'],
                'CreatedAt' => $row['CreatedAt'],
                'Enabled' => $row['Enabled'],
                'UpdatedAt' => $row['UpdatedAt']
            );
            array_push(  $userItems, $item); // Usar la variable $userItems en lugar de $menu
            $this->printJSON($userItems);
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

