<?php
include_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    $categoria_id= $_POST['categoria_id'];
    $modelo = $_POST['modelo_id'];
    $numero_serie = $_POST['numero_serie'];
    $estado = "Activo";

    $sql1 ="INSERT INTO equipos (numero_serie, categoria_id, modelo_id ) 
            VALUES ('$numero_serie', '$categoria_id', '$modelo')";

    
    $sql2 ="INSERT INTO inventario (numero_serie, estado) 
            VALUES ('$numero_serie', '$estado')";
    
    if ($conexion) {
        $resultado = mysqli_query($conexion, $sql1);
        $resultado2 = mysqli_query($conexion, $sql2);
        echo "Equipo creado con éxito.";
        
    } else {
        echo "Error al crear el equipo: " . $conexion->error;
    }


}
mysqli_close($conexion);


?>