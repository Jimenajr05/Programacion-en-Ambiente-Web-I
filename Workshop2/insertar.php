<?php
// Datos de conexión 
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDatos = "workshop2";

// Evita excepciones 
mysqli_report(MYSQLI_REPORT_OFF);

// Conexión a la base de datos
$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDatos);

if (!$conexion) {
    die("Error al conectar: " .mysqli_connect_error());
}

// Obtiene datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Validar formato del correo 
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $mensaje = "El correo no es válido.";
    $color ="red";
    mysqli_close($conexion);
    header("Location: resultado.php?mensaje=" . urlencode($mensaje) . "&color=" . $color);
    exit;   
}

// Consulta sql para isertar los datos
$sql = "INSERT INTO usuarios (nombre, apellido, correo, telefono)
        VALUES ('$nombre', '$apellido', '$correo', '$telefono')";

// Ejecuta consulta y valida
if (mysqli_query($conexion, $sql)) {
    $mensaje = "Registro exitoso.";
    $color = "green";
}else{
    if (mysqli_errno($conexion) == 1062) {
        $mensaje = "El correo ya está registrado.";
        $color = "red";
    }else{
        $mensaje = "Error: " . mysqli_error($conexion);
        $color = "red";
    }
}

// Cierra Conexión
mysqli_close($conexion);

// Redirige a la página de resultado
header("Location: resultado.php?mensaje=" . urlencode($mensaje) . "&color=" . $color);
exit;
?>