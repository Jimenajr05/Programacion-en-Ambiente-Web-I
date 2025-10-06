<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h1>Inicio de Sesión</h1>
    
    <form method="post" action="printLogin.php">
        <label>Usuario:</label><br>
        <input type="text" name="username"
            value="<?php echo isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario']) : ''; ?>"
            required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
    
        <button type="submit">Ingresar</button>
    </form>
  
  <p>¿No tienes cuenta? <a href="formRegistro.php">Regístrate aquí</a></p>

</body>
</html>