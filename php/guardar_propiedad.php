<?php
include '../controladores/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $ubicacion = $_POST['ubicacion'];
    $contacto = $_POST['contacto'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $fecha_publicacion = $_POST['fecha_publicacion'];

    // Manejar la subida de la imagen
    $imagen = $_FILES['imagen']['name'];
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $imagen_ruta = "../../admin/uploads/" . $imagen;

    if (move_uploaded_file($imagen_tmp, $imagen_ruta)) {
        // Preparar la consulta SQL
        $stmt = $conexion->prepare("INSERT INTO propiedades (titulo, descripcion, precio, ubicacion, contacto, tipo, estado, fecha_publicacion, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdssssss", $titulo, $descripcion, $precio, $ubicacion, $contacto, $tipo, $estado, $fecha_publicacion, $imagen);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al subir la imagen']);
    }

    $conexion->close();
}
?>