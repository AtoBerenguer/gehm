<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    
    $serie = $_GET['numero_serie'];
    $serie = mysqli_real_escape_string($conexion, $serie);

    // Verificar si el Equipo existe haciendo un select con el id que queremos eliminar
    $sql_check = "SELECT numero_serie FROM equipos WHERE numero_serie = '$serie'";
    $resultado = mysqli_query($conexion, $sql_check);

    if (mysqli_num_rows($resultado) > 0) { // En caso de que el Equipo exista habra un resultado > 0
        $sql_delete = "DELETE FROM equipos WHERE numero_serie = '$serie'";
        if (mysqli_query($conexion, $sql_delete)) {
            echo "Equipo eliminado con éxito. ID $serie" ;
        } else {
            echo "Error al eliminar el equipo: " . mysqli_error($conexion);
        }
    } else {
        // El Equipo no existe
        echo "El Equipo con ID $serie no existe.";
    }

   
}
?>