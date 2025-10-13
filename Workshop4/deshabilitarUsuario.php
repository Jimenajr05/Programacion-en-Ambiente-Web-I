<?php
include("conexion.php");
session_start();

$id = $_GET["id"];

// Usuario actualmente logueado
$usuarioActual = $_SESSION["usuario"];

// Consulta para obtener el nombre del usuario a deshabilitar
$sqlUsuario = "SELECT usuario FROM usuarios WHERE id = $id";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);

if (!$resultadoUsuario) {
    die("<p style='color:red;'>Error al verificar usuario: " . mysqli_error($conexion) . "</p>");
}

// Obtiene una fila del resultado de la consulta
$fila = mysqli_fetch_assoc($resultadoUsuario);

// Guarda el nombre del usuario que se desea deshabilitar
$usuarioDeshabilitar = $fila["usuario"];

// Evita que un usuario se deshabilite a sí mismo
if ($usuarioActual === $usuarioDeshabilitar) {
    echo "<p style='color:red;'>No puedes deshabilitar tu propia cuenta mientras estás logueado.</p>";
    echo "<button type='button' onclick=\"location.href='usuarios.php'\">Regresar a la lista</button>";
    include("cerrarConexion.php");
    exit();
}

// Deshabilita el usuario (activo = 0)
$sql = "UPDATE usuarios SET activo = 0 WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("<p style='color:red;'>Error al deshabilitar usuario: " . mysqli_error($conexion) . "</p>");
}

include("cerrarConexion.php");
header("Location: usuarios.php");
exit();
?>