<?php
// leer.php - Archivo para obtener todos los usuarios

// Incluir archivo de conexión
require_once 'conexion.php';

$usuarios = [];
$error = null;

// Preparar la consulta SQL
$stmt = $conexion->prepare("SELECT id, nombre, email, telefono FROM usuarios ORDER BY id DESC");

// Ejecutar la consulta
if ($stmt->execute()) {
    // Obtener resultados
    $resultado = $stmt->get_result();
    
    // Recorrer resultados y convertir a array asociativo
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $usuarios
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al obtener los usuarios: ' . $stmt->error
    ]);
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conexion->close();
?>