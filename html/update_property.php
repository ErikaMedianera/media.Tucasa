<?php
include '../controladores/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_propiedad = $_POST['id_propiedad'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $ubicacion = $_POST['ubicacion'];
    $contacto = $_POST['contacto'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $imagen = $_FILES['imagen'];

    // Validar los datos
    if (empty($id_propiedad) || empty($titulo) || empty($descripcion) || empty($precio) || empty($ubicacion) || empty($contacto) || empty($tipo) || empty($estado) || empty($fecha_publicacion)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        exit;
    }

    // Validar la imagen
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

    // Actualizar la información en la base de datos
    if ($imagen_ruta) {
        $stmt = $conexion->prepare("UPDATE propiedades SET titulo = ?, descripcion = ?, precio = ?, ubicacion = ?, contacto = ?, tipo = ?, estado = ?, fecha_publicacion = ?, imagen = ? WHERE id_propiedad = ?");
        $stmt->bind_param("ssissssssi", $titulo, $descripcion, $precio, $ubicacion, $contacto, $tipo, $estado, $fecha_publicacion, $imagen_ruta, $id_propiedad);
    } else {
        $stmt = $conexion->prepare("UPDATE propiedades SET titulo = ?, descripcion = ?, precio = ?, ubicacion = ?, contacto = ?, tipo = ?, estado = ?, fecha_publicacion = ? WHERE id_propiedad = ?");
        $stmt->bind_param("ssisssssi", $titulo, $descripcion, $precio, $ubicacion, $contacto, $tipo, $estado, $fecha_publicacion, $id_propiedad);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la propiedad en la base de datos']);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido']);
}
?>