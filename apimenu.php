<?php
// include_once 'apimenu.php';
include_once 'menu.php';

class ApiMenu {
    function getAll() {
        $menu = new Menu();
        $response = array();
        $response["items"] = array();
        $respuesta = $menu->getMenu();

        if ($respuesta->rowCount()) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'IdMenu' => $row['IdMenu'],
                    'NameMenu' => $row['NameMenu'],
                    'IdCatalogoMenu' => $row['IdCatalogoMenu'],
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

    function getById($IdMenu) {
        $menu = new Menu(); // Crear una instancia de la clase Menu
        $menuItems = array(); // Cambiar el nombre de la variable para evitar sobrescribir la instancia
    
        $res = $menu->obtenerMenu($IdMenu);
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        
            $item = array(
                'IdMenu' => $row['IdMenu'],
                'NameMenu' => $row['NameMenu'],
                'IdCatalogoMenu' => $row['IdCatalogoMenu'],
                'CreatedAt' => $row['CreatedAt'],
                'UpdatedAt' => $row['UpdatedAt'],
                'Enabled' => $row['Enabled']
            );
            array_push($menuItems, $item); // Usar la variable $menuItems en lugar de $menu
            $this->printJSON($menuItems);
        } else {
            $this->error('No hay elementos');
        }
    }

    function eliminarById($IdMenu) {
        $menu = new Menu(); // Crear una instancia de la clase Menu
    
        $res = $menu->obtenerMenu($IdMenu); // Obtener el menú por IdMenu
    
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
    
            // Obtener los datos del menú
            $IdMenu = $row['IdMenu'];
            $NameMenu = $row['NameMenu'];
            $IdCatalogoMenu = $row['IdCatalogoMenu'];
            $CreatedAt = $row['CreatedAt'];
            $UpdatedAt = $row['UpdatedAt'];
            $Enabled = $row['Enabled'];
    
            // Eliminar el menú
            $menu->eliminarMenu($IdMenu);
    
            $item = array(
                'IdMenu' => $IdMenu,
                'NameMenu' => $NameMenu,
                'IdCatalogoMenu' => $IdCatalogoMenu,
                'CreatedAt' => $CreatedAt,
                'UpdatedAt' => $UpdatedAt,
                'Enabled' => $Enabled
            );
    
            $this->printJSON($item);
        } else {
            $this->error('chupapijas borrado');
        }
    }

     function insertarMenu($IdMenu, $NameMenu, $IdCatalogoMenu, $CreatedAt, $UpdatedAt, $Enabled) {
        $menu = new Menu(); // Crear una instancia de la clase Menu
    
        // Realizar la inserción en la base de datos
        $query = $menu->connect()->prepare('INSERT INTO menu (IdMenu, NameMenu, IdCatalogoMenu, CreatedAt, UpdatedAt, Enabled) VALUES (:IdMenu, :NameMenu, :IdCatalogoMenu, :CreatedAt, :UpdatedAt, :Enabled)');
        $query->execute([
            'IdMenu' => $IdMenu,
            'NameMenu' => $NameMenu,
            'IdCatalogoMenu' => $IdCatalogoMenu,
            'CreatedAt' => $CreatedAt,
            'UpdatedAt' => $UpdatedAt,
            'Enabled' => $Enabled
        ]);
    
        // Verificar si la inserción fue exitosa
        if ($query) {
            return true;
        } else {
            return false;
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