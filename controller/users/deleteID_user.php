<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    
    $id = $_GET['id_usuario'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sql_check = "SELECT id_usuario FROM usuarios WHERE id_usuario = $id";
    $resultado = mysqli_query($conexion, $sql_check);

    if (mysqli_num_rows($resultado) > 0) { // En caso de que el usuario exista habra un resultado > 0
        
        $sql_delete = "DELETE FROM usuarios WHERE id_usuario = $id";
        
        
        if (mysqli_query($conexion, $sql_delete)) {
            echo "Usuario eliminado con éxito.";
        } else {
            echo "Error al eliminar el usuario: " . mysqli_error($conexion);
        }
    } else {
        echo "El usuario con ID $id no existe.";
    }

  
}
mysqli_close($conexion);

?>