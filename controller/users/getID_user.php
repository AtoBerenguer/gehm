<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id_usuario'];
    $id = mysqli_real_escape_string($conexion, $id);
    $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $usuario = mysqli_fetch_assoc($resultado);
        header('Content-Type: application/json');
        echo json_encode($usuario);
    } else {
        echo "Error en la petición". mysqli_error($conexion);
    }   

}

mysqli_close($conexion);
?>