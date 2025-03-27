<?php
include("../controladores/conexion.php");

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $ubicacion = $_POST['ubicacion'];
    $contacto = $_POST['contacto'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $fecha_publicacion = $_POST['fecha_publicacion'];

    // Manejar la imagen
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../imagenes/"; // Carpeta donde se guardarán las imágenes
        $imageName = basename($_FILES['imagen']['name']);
        $targetFilePath = $targetDir . $imageName;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFilePath)) {
            $imagen = $imageName;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al subir la imagen.']);
            exit;
        }
    }

    // Preparar la consulta SQL
    $stmt = $conexion->prepare("INSERT INTO propiedades (titulo, descripcion, imagen, precio, contacto, ubicacion, tipo, estado, fecha_publicacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $conexion->error]);
        exit;
    }

    // Vincular los parámetros
    $stmt->bind_param("sssdsssss", $titulo, $descripcion, $imagen, $precio, $contacto, $ubicacion, $tipo, $estado, $fecha_publicacion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Propiedad registrada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar la propiedad: ' . $stmt->error]);
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}
?>