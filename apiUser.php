<?php
include_once 'user.php';
class ApiUser {
    function getAll() {
        $user = new User();
        $response = array();
        $response["items"] = array();
        $respuesta = $user->getUser();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdUser' => $row['IdUser'],
                    'IdPersonal' => $row['IdPersonal'],
                    'NameUser' => $row['NameUser'],
                    'LastName' => $row['LastName'],
                    'Email' => $row['Email'],
                    'UserName' => $row['UserName'],
                    'Password' => $row['Password'],
                    'IdRol' => $row['IdRol'],
                    'CreatedAt' => $row['CreatedAt'],
                    'Enabled' => $row['Enabled'],
                    'UpdateAt' => $row['UpdateAt'],
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
    
        $res = $user->obtenerUser($IdUser);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdUser' => $row['IdUser'],
                'ldPersonal' => $row['ldPersonal'],
                'NameUser' => $row['NameUser'],
                'LastName' => $row['LastName'],
                'Email' => $row['Email'],
                'UserName' => $row['UserName'],
                'Password' => $row['Password'],
                'IdRol' => $row['IdRol'],
                'CreatedAt' => $row['CreatedAt'],
                'Enabled' => $row['Enabled'],
                'UpdateAt' => $row['UpdateAt']
            );
            array_push(  $userItems, $item); // Usar la variable $userItems en lugar de $user
            $this->printJSON($userItems);
        } else {
            $this->error('No hay elementos');
        }
    }

    function insertarUser($IdUser, $ldPersonal, $NameUser, $LastName, $Email, $UserName, $Password, $IdRol, $CreatedAt, $Enabled, $UpdateAt) {
        $user = new User(); // Crear una instancia de la clase User
    
        // Insertar el usuario en la base de datos
        $resultado = $user->insertarUser($IdUser, $ldPersonal, $NameUser, $LastName, $Email, $UserName, $Password, $IdRol, $CreatedAt, $Enabled, $UpdateAt);
    
        if ($resultado) {
            // Los datos del usuario se insertaron correctamente
        } else {
            $this->error('Error al insertar el usuario');
        }
    }

    function eliminarById($IdUser) {
        $user = new user(); // Crear una instancia de la clase user
    
        $res = $user->obtenerUser($IdUser); // Obtener el menú por IdUser
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
    
            // Obtener los datos del menú
            $IdUser = $row['IdUser'];
            $IdPersonal = $row['IdPersonal'];
            $NameUser = $row['NameUser'];
            $LastName = $row['LastName'];
            $Email = $row['Email'];
            $UserName = $row['UserName'];
            $Password = $row['Password'];
            $IdRol = $row['IdRol'];
            $CreatedAt = $row['CreatedAt'];
            $Enabled = $row['Enabled'];
            $UpdateAt = $row['UpdateAt'];
    
            // Eliminar el menú
            $user->eliminarUser($IdUser);
    
            $item = array(
                'IdUser' => $row['IdUser'],
                'IdPersonal' => $row['IdPersonal'],
                'NameUser' => $row['NameUser'],
                'LastName' => $row['LastName'],
                'Email' => $row['Email'],
                'UserName' => $row['UserName'],
                'Password' => $row['Password'],
                'IdRol' => $row['IdRol'],
                'CreatedAt' => $row['CreatedAt'],
                'Enabled' => $row['Enabled'],
                'UpdateAt' => $row['UpdateAt']
            );
    
            $this->printJSON($item);
        } else {
            $this->error('no se encontró');
        }
    }


     function editarUser($IdUser, $IdPersonal, $NameUser, $LastName, $Email, $UserName, $Password, $IdRol, $CreatedAt, $Enabled, $UpdateAt)
    {
        $user = new User(); // Crear una instancia de la clase User

        // Actualizar el usuario en la base de datos
        $resultado = $user->editarUser($IdUser, $IdPersonal, $NameUser, $LastName, $Email, $UserName, $Password, $IdRol, $CreatedAt, $Enabled, $UpdateAt);

        if ($resultado) {
            // Éxito en la edición del usuario
        } else {
            // Error al editar el usuario
            $this->error('Error al editar el usuario');
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

