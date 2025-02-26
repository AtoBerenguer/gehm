<?php
    include_once '../db.php';


    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id_modelo'];
        $id = mysqli_real_escape_string($conexion, $id);
        $sql = "SELECT * FROM modelos WHERE id_modelo = $id";

        if ($resultado = mysqli_query($conexion, $sql)) {
            $modelo = mysqli_fetch_assoc($resultado);
            header('Content-Type: application/json');
            echo json_encode($modelo);
        } else {
            echo "Error en la petición". mysqli_error($conexion);
        }
    }
    mysqli_close($conexion);
?>