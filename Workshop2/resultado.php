<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['mensaje'])) {
            $mensaje = $_GET['mensaje'];
            $color = $_GET['color'];
            echo "<h2 style='color:$color;'>$mensaje</h2>";
        }
        ?>
        <a href= "formulario.html" class="btn-volver">Volver al formulario</a>
    </div>
</body>

</html>