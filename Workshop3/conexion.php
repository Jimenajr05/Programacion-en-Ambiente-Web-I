<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDatos = "workshop3";

$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDatos);

if (!$conexion) {
    die("Error al conectar: " . mysqli_connect_error());
}
?>