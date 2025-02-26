<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id_inventario'];
    $id = mysqli_real_escape_string($conexion, $id);
    $sql = "SELECT * FROM inventario WHERE id_inventario = $id";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $equipo = mysqli_fetch_assoc($resultado);
        header('Content-Type: application/json');
        echo json_encode($equipo);
    } else {
        echo "Error en la petición". mysqli_error($conexion);
    }   

}

mysqli_close($conexion);
?>