<?php
// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "TuCasa";

$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Establecer juego de caracteres
$conexion->set_charset("utf8");
?>