<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['columna']) && isset($_GET['valor'])) {
        $columna = $_GET['columna'];
        $valor = $_GET['valor'];

        $columnasPermitidas = ['categorias', 'MARCA','SerialNumber']; // Agrega aquí las columnas que deseas permitir
        if (!in_array($columna, $columnasPermitidas)) {
            echo "Columna no permitida.";
            exit;
        }

        $valor = mysqli_real_escape_string($conexion, $valor);

        $sql = "SELECT * FROM inventario WHERE $columna = '$valor'";

        if ($resultado = mysqli_query($conexion, $sql)) {
            $equipos = [];
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $equipos[] = $fila;
            }
            header('Content-Type: application/json');
            echo json_encode($equipos);
        } else {
            echo "Error en la petición: " . mysqli_error($conexion);
        }
    } else {
        echo "Los parámetros 'columna' y 'valor' son requeridos.";
    }
}

mysqli_close($conexion);
?>