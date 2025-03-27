<?php
include '../../controladores/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);
    $confirmarContraseña = trim($_POST['confirmcontraseña']);
    
    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($contraseña) || empty($confirmarContraseña)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Validar que las contraseñas coincidan
    if ($contraseña !== $confirmarContraseña) {
        echo json_encode(['status' => 'error', 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    // Validar el formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Correo electrónico inválido.']);
        exit;
    }

    // Hashear la contraseña
    $hashedPassword = password_hash($contraseña, PASSWORD_DEFAULT);

    // Conectar a la base de datos
  
    // Sentencia SQL para insertar los datos
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Registro exitoso.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar.']);
    }

    $stmt->close();
    $conn->close();
}
?>