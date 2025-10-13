<?php
include("conexion.php");
session_start(); 

$id = $_GET["id"];

// Guarda el usuario que está actualmente logueado
$usuarioActual = $_SESSION["usuario"];

// Consulta para obtener el nombre de usuario que se quiere eliminar
$sqlUsuario = "SELECT usuario FROM usuarios WHERE id=$id";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);

if (!$resultadoUsuario) {
    die("<p style='color:red;'>Error al verificar usuario: " . mysqli_error($conexion) . "</p>");
}

// Obtiene una fila del resultado de la consulta
$fila = mysqli_fetch_assoc($resultadoUsuario);

// Guarda el nombre del usuario que se desea eliminar
$usuarioAEliminar = $fila["usuario"];

// Evita que el usuario se elimine a sí mismo
if ($usuarioActual === $usuarioAEliminar) {
    echo "<p style='color:red;'>No puedes eliminar tu propia cuenta mientras estás logueado.</p>";
    echo "<button type='button' onclick=\"location.href='usuarios.php'\">Regresar a la lista</button>";
    include("cerrarConexion.php");
    exit();
}

// Si no es el mismo usuario, se elimina
$sql = "DELETE FROM usuarios WHERE id=$id";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("<p style='color:red;'>Error al eliminar usuario: " . mysqli_error($conexion) . "</p>");
}

include("cerrarConexion.php");
header("Location: usuarios.php");
exit();
?>