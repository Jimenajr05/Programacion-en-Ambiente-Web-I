<?php
include("conexion.php");
// Inicia la sesión 
session_start();
?>

<!DOCTYPE html>
<html lang= "es">
    <head>
        <meta charset="UTF-8">
        <title>Iniciar Sesión</title>
    </head>

    <body>
        <h1>Iniciar Sesión</h2>

        <?php
        // Si el formulario fue enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Se obtienen los valores ingresados por el usuario
            $usuario = $_POST["usuario"];
            $clave = md5($_POST["clave"]);

            // Consulta sin filtrar por activo (para poder mostrar mensaje si está deshabilitado)
            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";

            // Ejecuta la consulta
            $resultado = mysqli_query($conexion, $sql);

            if (!$resultado) {
                die("Error al consultar usuarios: " . mysqli_error($conexion));
            }

            // Si existe el usuario
            if (mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);

                // Si el usuario está deshabilitado
                if ($fila["activo"] == 0) {
                    echo "<p style='color:red;'>Tu cuenta está deshabilitada. Por favor contacta al soporte para reactivarla.</p>";
                } else {
                    // Si está activo, inicia sesión
                    $_SESSION["usuario"] = $fila["usuario"];
                    $_SESSION["rol"] = $fila["rol"];
                    header("Location: principal.php");
                    exit();
                }
            } else {
                // Si no se encontró el usuario o la contraseña no coincide
                echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
            }
        }
        ?>

        <form method = "POST" action = "">
            <label>Usuario:</label><br>
            <input type = "text" name = "usuario" required><br><br>

            <label>Contraseña:</label><br>
            <input type = "password" name = "clave" required><br><br>

            <button type = "submit">Entrar</button>
        </form>
    </body>
</html>

<?php
include("cerrarConexion.php");
?>