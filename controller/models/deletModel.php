<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['id_modelo'];
        $id = mysqli_real_escape_string($conexion, $id);

        $sql_check = "SELECT id_modelo FROM modelos WHERE id_modelo = $id";
        $resultado = mysqli_query($conexion, $sql_check);

        if (mysqli_num_rows($resultado) > 0) { // En caso de que el modelo exista habra un resultado > 0

            $sql_delete = "DELETE FROM modelos WHERE id_modelo = $id";

            if (mysqli_query($conexion, $sql_delete)) {
                echo "Modelo eliminado con éxito. ID $id";
            } else {
                echo "Error al eliminar el modelo: " . mysqli_error($conexion);
            }
        } else {
            // El modelo no existe
            echo "El modelo con ID $id no existe.";
        }

}
?>