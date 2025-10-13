<?php
include("conexion.php");

$id = $_GET["id"];

// Actualiza el estado del usuario a activo (1)
$sql = "UPDATE usuarios SET activo = 1 WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);


if (!$resultado) {
    die("<p style='color:red;'> Error al habilitar usuarios: " . mysqli_error($conexion) . "</p>");
}

include("cerrarConexion.php");
header("Location: usuarios.php");
exit();
?>