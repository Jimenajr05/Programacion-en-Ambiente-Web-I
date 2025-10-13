<?php
include("conexion.php");
session_start();
?>

<!DOCTYPE html>
<html lang= "es">
    <head>
        <meta charset="UTF-8">
        <title>Agregar Usuario</title>
    </head>

    <body>
        <h1>Agregar Usuario</h2>
        <hr>

    <?php
    // Si se presiona el botón "Guardar"
    if (isset($_POST["guardar"])) {
        $nombre = $_POST["nombre"];
        $usuario = $_POST["usuario"];
        $clave = md5($_POST["clave"]); 
        $rol = $_POST["rol"];

        // Verificar si el usuario ya existe
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $existe = mysqli_query($conexion, $verificar);

        if (mysqli_num_rows($existe) > 0) {
            echo "<p style='color:red;'>El usuario ya existe. Intente con otro nombre de usuario.</p>";
        } else {
            // Inserta el nuevo usuario
            $sql = "INSERT INTO usuarios (nombre, usuario, clave, rol)
                    VALUES ('$nombre', '$usuario', '$clave', '$rol')";
            $resultado = mysqli_query($conexion, $sql);

            if (!$resultado) {
                die("<p style='color:red;'>Error al agregar usuario: " . mysqli_error($conexion) . "</p>");
            }

            echo "<p style='color:green;'> Usuario agregado correctamente.</p>";
            echo "<button type='button' onclick=\"location.href='usuarios.php'\">Regresar a la lista</button>";

            include("cerrarConexion.php");
            exit(); 
        }
    }
    ?>
    <!-- Formulario para agregar usuario -->
    <form method = "POST" action = "">
        <label>Nombre:</label><br>
        <input type = "text" name = "nombre" required><br><br>

        <label>Usuario:</label><br>
        <input type = "text" name = "usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type = "password" name = "clave" required><br><br>

        <label>Rol:</label><br>
        <select name="rol">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
        </select><br><br>

        <button type = "submit" name= "guardar">Guardar Usuario</button>
        <button type="button" onclick="location.href='usuarios.php'">Cancelar</button>
    </form>
    
    </body>
</html>

<?php
include("cerrarConexion.php");
?>