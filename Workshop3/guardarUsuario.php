<?php
include("conexion.php");

// Captura los datos del formulario 
$nombre = strtoupper($_POST['nombre']);
$apellido1 = strtoupper($_POST['apellido1']);
$apellido2 = strtoupper($_POST['apellido2']);
$provincia = $_POST['provincia'];
$username = strtoupper($_POST['username']);
$password = $_POST['password'];

// Cifra la contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

// Verifica si el nombre de usuario ya existe
$verificar = "SELECT id FROM usuarios WHERE username = '$username'";
$resultado = mysqli_query($conexion, $verificar);

if (mysqli_num_rows($resultado) > 0) {
    // Si existe, muestra un mensaje
    echo "<h3 style='color:red;'>El nombre de usuario <strong>$username</strong> ya está registrado.</h3>";
    echo "<a href='formRegistro.php'>Volver al registro</a>";
} else {
    // Si no existe, inserta el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, provincia_id, username, password)
        VALUES ('$nombre', '$apellido1', '$apellido2', '$provincia', '$username', '$hash')";
    
    // Si se guarda correctamente, redirige al login
    if (mysqli_query($conexion, $sql)) {
        header("Location: login.php?usuario=" . urlencode($username));
        exit();
    }else{
        echo "Error al guardar: " . mysqli_error($conexion);
    }
}

include("cerrarConexion.php");
?>