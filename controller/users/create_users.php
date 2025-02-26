<?php

include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    
    $contraseña = $_POST['contraseña']; // ¡No se hashea la contraseña!
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    
    $sql = "INSERT INTO usuarios (NOMBRE, APELLIDOS, CONTRASEÑA, EMAIL, rol) 
            VALUES ('$nombre', '$apellidos','$contraseña', '$email', '$rol')";

   
    if ($conexion) {
        $resultado = mysqli_query($conexion, $sql);
        echo "Usuario creado con éxito.";
    } else {
        echo "Error al crear el usuario: " . $conexion->error;
    }
}
mysqli_close($conexion);


?>