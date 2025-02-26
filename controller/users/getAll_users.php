<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        // Crear un array para almacenar los datos
        $usuarios = [];

        // Recorrer los resultados y guardarlos en el array
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $fila; // Agregar cada fila al array
        }

        // Devolver los resultados en formato JSON
        header('Content-Type: application/json');
        echo json_encode($usuarios);
    } else {
        echo json_encode(['error' => 'Fallo en la consulta: ' . mysqli_error($conexion)]);
    }

    mysqli_close($conexion);
}
?>