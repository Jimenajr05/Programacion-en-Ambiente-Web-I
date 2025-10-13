<?php
include("conexion.php");
session_start();
?>

<!DOCTYPE html>
<html lang= "es">
    <head>
        <meta charset="UTF-8">
        <title>Página Principal</title>
    </head>


    <body>
        <!-- Muestra el nombre del usuario conectado -->
        <h1>¡Bienvenid@, <?= $_SESSION["usuario"] ?>!</h2>
        <hr>

        <?php if($_SESSION["rol"] == "admin"): ?>
            <p>Eres <strong>administrador</strong> y tienes acceso total al sistema.</p>
        <?php else: ?>
            <p>Eres un <strong> usuario normal</strong>. Puedes ver la lista de usuarios, pero no modificarlos.</p>
        <?php endif; ?>

        <button type="button" onclick="location.href='usuarios.php'">Ver usuarios</button>
        <button type="button" onclick="location.href='login.php'">Cerrar Sesión</button>

    </body>
</html>

<?php
include("cerrarConexion.php");
?>