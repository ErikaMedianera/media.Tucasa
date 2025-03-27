<?php

include("../controladores/conexion.php");
header('Content-Type: application/json');

// Simulación de conexión a la base de datos

// Obtener los datos enviados desde el frontend
$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data['nombre'];
$email = $data['email'];
$contraseña = $data['contraseña'];

// Consulta para verificar si el usuario existe
$sql = "SELECT * FROM usuarios WHERE nombre = ? AND email = ? AND contraseña = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $contraseña);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Usuario encontrado
    echo json_encode(['success' => true]);
} else {
    // Usuario no registrado
    echo json_encode(['success' => false, 'message' => 'usuario_no_registrado']);
}

$stmt->close();
$conexion->close();
?>