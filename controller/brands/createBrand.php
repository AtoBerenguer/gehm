<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_marca = $_POST['nombre_marca'];

    $sql = "INSERT INTO marcas (nombre_marca) VALUES ('$nombre_marca')";

    if ($conexion) {
        $resultado = mysqli_query($conexion, $sql);
        echo "Marca creado con éxito.";
    } else {
        echo "Error al crear la marca: " . mysqli_error($conexion);
    }
}
?>  