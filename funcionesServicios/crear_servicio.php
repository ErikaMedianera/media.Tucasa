<?php
include '../controladores/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen'];

    if (empty($titulo) || empty($descripcion)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        exit;
    }

    $imagen_ruta = null;
    if ($imagen['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($imagen['type'], $allowed_types)) {
            echo json_encode(['status' => 'error', 'message' => 'Tipo de imagen no permitido']);
            exit;
        }

        $imagen_ruta = '../uploads/' . basename($imagen['name']);
        if (!move_uploaded_file($imagen['tmp_name'], $imagen_ruta)) {
            echo json_encode(['status' => 'error', 'message' => 'Error al subir la imagen']);
            exit;
        }
    }

    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, imagen) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descripcion, $imagen_ruta);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al crear el servicio']);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido']);
}
?>