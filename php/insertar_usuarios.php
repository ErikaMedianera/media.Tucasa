<?php
// filepath: c:\xampp\htdocs\TuCasa.com\publica\php\insertar_usuario.php

// Conexión a la base de datos
include '../controladores/conexion.php';

header('Content-Type: application/json'); // Asegurarse de que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $confirm_contraseña = $_POST['confirmcontraseña'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($contraseña) || empty($confirm_contraseña)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Validar que las contraseñas coincidan
    if ($contraseña !== $confirm_contraseña) {
        echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    // Validar que el correo no esté registrado
    $query = "SELECT id_usuarios FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conexion->error]);
        exit;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El correo ya está registrado.']);
        exit;
    }

    // Encriptar la contraseña
    $contraseñaEncriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, email, contraseña, tipo) VALUES (?, ?, ?, 'cliente')";
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conexion->error]);
        exit;
    }
    $stmt->bind_param("sss", $nombre, $email, $contraseñaEncriptada);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario.']);
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>