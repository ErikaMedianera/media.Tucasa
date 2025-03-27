<?php
// filepath: c:\xampp\htdocs\TuCasa.com\publica\php\insertar_email.php

// Conexión a la base de datos
include '../controladores/conexion.php';

header('Content-Type: application/json'); // Asegurarse de que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $texto = $_POST['texto'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($texto)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Preparar la consulta para insertar los datos
    $query = "INSERT INTO email (nombre, email, texto) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
        exit;
    }

    // Vincular los parámetros
    $stmt->bind_param("sss", $nombre, $email, $texto);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al enviar el mensaje.']);
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>