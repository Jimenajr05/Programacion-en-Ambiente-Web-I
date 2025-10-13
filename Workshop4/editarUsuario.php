<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>
    </head>

    <body>
        <h2>Editar Usuario</h2>
        <hr>

        <?php
        // Obtiene el ID del usuario 
        $id = $_GET["id"];

        // Consulta los datos del usuario según su ID
        $consulta = "SELECT * FROM usuarios WHERE id=$id";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            die("<p style='color:red;'>Error al obtener usuario: " . mysqli_error($conexion) . "</p>");
        }
        
        // Guarda los datos del usuario en un arreglo
        $fila = mysqli_fetch_array($resultado);

        if (isset($_POST["guardar"])) {
            $nombre = $_POST["nombre"];
            $rol = $_POST["rol"];

            // Si el campo contraseña NO está vacío, se actualiza
            if (!empty($_POST["clave"])) {
                $clave = md5($_POST["clave"]);
                $actualizar = "UPDATE usuarios SET nombre = '$nombre', rol = '$rol', clave = '$clave' WHERE id = $id";
            } else {
                // Si no, no se cambia la contraseña
                $actualizar = "UPDATE usuarios SET nombre = '$nombre', rol = '$rol' WHERE id = $id";
            }

            // Ejecuta la actualización
            $resultadoActualizar = mysqli_query($conexion, $actualizar);

            if (!$resultadoActualizar) {
                die("<p style='color:red;'>Error al actualizar usuario: " . mysqli_error($conexion) . "</p>");
            }

            echo "<p style='color:green;'>Usuario actualizado correctamente.</p>";
            echo "<button type='button' onclick=\"location.href='usuarios.php'\">Regresar a la lista</button>";

            include("cerrarConexion.php");
            exit();
        }
        ?>

        <form method="POST">
            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="<?= $fila['nombre'] ?>" required><br><br>

            <label>Nueva Contraseña (opcional):</label><br>
            <input type="password" name="clave" placeholder="Dejar vacío para no cambiar"><br><br>

            <label>Rol:</label><br>
            <select name="rol">
                <option value="usuario" <?= ($fila['rol'] == "usuario") ? "selected" : "" ?>>Usuario</option>
                <option value="admin" <?= ($fila['rol'] == "admin") ? "selected" : "" ?>>Administrador</option>
            </select><br><br>

            <button type = "submit" name= "guardar">Guardar Cambios</button>
            <button type="button" onclick="location.href='usuarios.php'">Cancelar Cambios</button>
        </form>

    </body>
</html>

<?php
include("cerrarConexion.php");
?>