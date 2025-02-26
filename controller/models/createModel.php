<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_modelo = $_POST['nombre_modelo'];
    $marca_id = $_POST['marca_id'];

    $sql = "INSERT INTO modelos (nombre_modelo, marca_id) VALUES ('$nombre_modelo', '$marca_id')";

    if ($conexion) {
        $resultado = mysqli_query($conexion, $sql);
        echo "Modelo creado con éxito.";
    } else {
        echo "Error al crear el modelo: " . mysqli_error($conexion);
    }
}