<?php
include '../controladores/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['contraseña'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Consultar si el usuario existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $usuario['contraseña'])) {
            echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El usuario no está registrado. Por favor, regístrese.']);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>