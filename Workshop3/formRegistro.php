<?php
include("conexion.php");
$resultado = mysqli_query($conexion, "SELECT * FROM provincias");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
</head>
<body>
    <h1>Formulario de Registro</h1>
    
    <form method="post" action="guardarUsuario.php">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido1">Primer apellido:</label><br>
        <input type="text" id="apellido1" name="apellido1" required><br><br>

        <label for="apellido2">Segundo apellido:</label><br>
        <input type="text" id="apellido2" name="apellido2"><br><br>

        <label>Provincia:</label><br>
        <select name="provincia" required>
            <option value="">Seleccione una provincia</option>
            <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
                <option value="<?= $fila['id'] ?>"><?= $fila['nombre'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Nombre de usuario:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
    
        <button type="submit">Registrarse</button>
    </form>
  
  <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>

</body>
</html>

<?php
include("cerrarConexion.php");
?>