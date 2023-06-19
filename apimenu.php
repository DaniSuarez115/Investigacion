<?php
// include_once 'apimenu.php';
include_once 'menu.php';

// Crear una instancia de ApiRoles
$apiMenu = new ApiMenu();

// Llamar al método getAll() para obtener los datos
$apiMenu->getAll();



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