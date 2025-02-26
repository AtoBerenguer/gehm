<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id_marca'];
    $id = mysqli_real_escape_string($conexion, $id);
    $sql = "SELECT * FROM marcas WHERE id_marca = $id";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $marca = mysqli_fetch_assoc($resultado);
        header('Content-Type: application/json');
        echo json_encode($marca);
    } else {
        echo "Error en la petición". mysqli_error($conexion);
    }   

}

mysqli_close($conexion);
?>