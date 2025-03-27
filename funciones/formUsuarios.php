<?php
include '../controladores/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($contraseña)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Validar que el correo no esté registrado
    $query = "SELECT id_usuarios FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El correo ya está registrado.']);
        exit;
    }

    // Cifrar la contraseña antes de guardarla
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT); // Cifrado seguro

    // Insertar el nuevo usuario con el rol de cliente
    $query = "INSERT INTO usuarios (nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, 'cliente')";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sss", $nombre, $email, $contraseñaEncriptada);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario.']);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>


