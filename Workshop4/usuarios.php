<?php
include("conexion.php");
session_start();
?>

<!DOCTYPE html>
<html lang= "es">
    <head>
        <meta charset="UTF-8">
        <title>Listado de Usuarios</title>
    </head>

    <body>
        <h1>Listado de Usuarios</h2>

    <?php

    // Consulta todos los usuarios
    $query = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error al consultar usuarios: " . mysqli_error($conexion));
    }
    ?>

    <!-- Si el usuario es administrador, muestra botón para agregar -->
    <?php if($_SESSION["rol"] === "admin"): ?>
        <a href = "agregarUsuario.php"> + Agregar Usuario</a><br><br>
    <?php endif; ?>
    
    <!-- Tabla de usuarios -->
    <table border = "1" cellspacing = "0" cellpadding = "5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Activo</th>
                <?php if($_SESSION["rol"] === "admin"): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>    
        <tbody>
            <!-- Muestra los datos de cada usuario -->
            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?= $fila['id'] ?></td>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['usuario'] ?></td>
                    <td><?= $fila['rol'] ?></td>
                    <td><?= $fila['activo'] ? 'Sí' : 'No' ?></td>

                    <!-- Opciones disponibles solo para administrador -->
                    <?php if ($_SESSION["rol"] === "admin"): ?>
                        <td>
                            <a href="editarusuario.php?id=<?= $fila['id'] ?>">Editar</a> |
                            <a href="eliminarUsuario.php?id=<?= $fila['id'] ?>" onclick="return confirm('¿Desea eliminar este usuario?')">Eliminar</a> |
                            <?php if ($fila['activo']): ?>
                                <a href="deshabilitarUsuario.php?id=<?= $fila['id'] ?>">Deshabilitar</a>
                            <?php else: ?>
                                <a href="habilitarUsuario.php?id=<?= $fila['id'] ?>">Habilitar</a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
     
    <br>
    <button type="button" onclick="location.href='principal.php'">Regresar</button>

    </body>
</html>

<?php
include("cerrarConexion.php");
?>