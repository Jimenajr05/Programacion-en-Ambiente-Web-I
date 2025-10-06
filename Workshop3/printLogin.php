<?php
include("conexion.php");

// Captura los datos enviados desde el formulario
$username = strtoupper($_POST['username']);
$password = $_POST['password'];

// Consulta para buscar el usuario y obtener también el nombre de su provincia
$sql = "SELECT u.*, p.nombre AS provincia_nombre
        FROM usuarios u
        INNER JOIN provincias p ON u.provincia_id = p.id
        WHERE u.username = '$username'";

$result = mysqli_query($conexion, $sql);


// Verifica si se encontró el usuario
if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        echo "<h3>Bienvenid@, " . htmlspecialchars($row['nombre']) . " " . 
            htmlspecialchars($row['apellido1']) . " " . 
            htmlspecialchars($row['apellido2']) . ".</h3>";

        echo "<p>Provincia registrada: <strong>" . htmlspecialchars($row['provincia_nombre']) . "</strong></p>";
        
        echo '<a href="login.php">Cerrar sesión</a>';
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}

include("cerrarConexion.php");
?>