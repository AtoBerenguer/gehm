<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    
    $id = $_GET['id_marca'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sql_check = "SELECT id_marca FROM marcas WHERE id_marca = $id";
    $resultado = mysqli_query($conexion, $sql_check);

    if (mysqli_num_rows($resultado) > 0) { // En caso de que la marca exista habra un resultado > 0
        
        $sql_delete = "DELETE FROM marcas WHERE id_marca = $id";
        
        
        if (mysqli_query($conexion, $sql_delete)) {
            echo "Marca eliminado con éxito. ID $id";
        } else {
            echo "Error al eliminar la marca: " . mysqli_error($conexion);
        }
    } else {
        // La marca no existe
        echo "La marca con ID $id no existe.";
    }

  
}
mysqli_close($conexion);
?>