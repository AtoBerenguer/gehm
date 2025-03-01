<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') { // OBTENER TODAS LAS MARCAS Y ID
   
    $sql = "SELECT * FROM marcas";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $marcas = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $marcas[] = $fila;
        }
        header('Content-Type: application/json');
        echo json_encode($marcas);
        
    } else {
        echo "Error en la petición". mysqli_error($conexion);
    }   

}

mysqli_close($conexion);
?>