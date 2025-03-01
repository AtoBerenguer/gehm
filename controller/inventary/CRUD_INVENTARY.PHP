<?php
include_once '../db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Crear nuevo equipo
        //PARA CREAR UN INVENTARIO (EQUIPO) necesitamos los siguientes datos:
        //UN NUMERO DE SERIE, UNA CATEGORIA_ID(TIPOLOGIA), Y UN MODELO_ID(MODELO) estos datos
        //por ejemplo TIPOLOGIA, VA RELACIONADO A UNA TABLA DE CATAGORIAS
        //MODELO, VA RELACIONADO A UNA TABLA DE MODELOS Y A UNA TABLA MARCAS.

    break;
    
    case 'GET':
        $sql = "SELECT 
            i.id_inventario, 
            i.numero_serie, 
            i.estado, 
            e.categoria_id, 
            c.nombre_categoria, 
            e.modelo_id, 
            m.nombre_modelo, 
            mrc.id_marca, 
            mrc.nombre_marca
        FROM inventario i
        LEFT JOIN equipos e ON i.numero_serie = e.numero_serie
        LEFT JOIN categorias c ON e.categoria_id = c.id_categoria
        LEFT JOIN modelos m ON e.modelo_id = m.id_modelo
        LEFT JOIN marcas mrc ON m.marca_id = mrc.id_marca";

        if ($resultado = mysqli_query($conexion, $sql)) {
            $inventario = [];
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $inventario[] = $fila;
            }
            header('Content-Type: application/json');
            echo json_encode($inventario);
        } else {
            echo "Error en la petición: " . mysqli_error($conexion);
        }
   
        break;
    case 'DELETE':
        // Eliminar equipo
        $id = $_GET['id_inventario'];
        $id = mysqli_real_escape_string($conexion, $id);

        $sql_check = "SELECT id_inventario FROM inventario WHERE id_inventario = $id";
        $resultado = mysqli_query($conexion, $sql_check);

        if (mysqli_num_rows($resultado) > 0) { // En caso de que la marca exista habra un resultado > 0
            
            $sql_delete = "DELETE FROM inventario WHERE id_inventario = $id";
            
            
            if (mysqli_query($conexion, $sql_delete)) {
                echo "Equipo eliminado con éxito. ID $id";
            } else {
                echo "Error al eliminar el equipo: " . mysqli_error($conexion);
            }
        } else {
            // El equipo no existe
            echo "El equipo con ID $id no existe.";
        }
        break;


        default:
        echo "Método no permitido";
        break;
}

mysqli_close($conexion);    

?>  