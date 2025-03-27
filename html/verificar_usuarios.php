<?php
session_start();
include '../controladores/conexion.php';

// Lista de usuarios permitidos (puedes reemplazar esto con una consulta a la base de datos)
$usuarios_permitidos = [
    [
        'nombre' => 'Medianera',
        'email' => 'medianera@gmail.com',
        'contraseña' => password_hash('medianera123456', PASSWORD_DEFAULT) // Contraseña encriptada
    ],
    [
        'nombre' => 'MiLeydi',
        'email' => 'mileydi@gmail.com',
        'contraseña' => password_hash('mileydi123456', PASSWORD_DEFAULT) // Contraseña encriptada
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($contraseña)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Verificar si el usuario está en la lista de usuarios permitidos
    foreach ($usuarios_permitidos as $usuario) {
        if ($usuario['nombre'] === $nombre && $usuario['email'] === $email && password_verify($contraseña, $usuario['contraseña'])) {
            // Credenciales válidas, iniciar sesión
            $_SESSION['rol'] = 'administrador';
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $email;
            echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso.']);
            exit;
        }
    }

    // Si no se encuentra el usuario
    echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas.']);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>