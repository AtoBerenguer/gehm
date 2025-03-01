<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM inventario";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $inventario = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $inventario[] = $fila;
        }
        header('Content-Type: application/json');
        echo json_encode($inventario);
    } else {
        echo "Error en la petición". mysqli_error($conexion);
    }   

}



// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//     $sql = "SELECT * FROM inventario";

//     if ($resultado = mysqli_query($conexion, $sql)) {
//         $inventario = array();
//         while ($datos = mysqli_fetch_assoc($resultado)) {
//             array_push($inventario, $datos);
//         }
//         header('Content-Type: application/json');
//         echo json_encode($inventario);
//     } else {
//         echo "Error en la petición". mysqli_error($conexion);
//     }   

// }   
?>