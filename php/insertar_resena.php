<?php
// filepath: c:\xampp\htdocs\TuCasa.com\publica\php\insertar_resena.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    $mysqli = new mysqli('localhost', 'root', '', 'TuCasa');

    if ($mysqli->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
        exit;
    }

    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $comentario = $_POST['comentario'];
    $imagen = $_FILES['imagen']['name'] ?? null;

    // Subir la imagen si se proporciona
    if ($imagen) {
        $targetDir = "../imagenes/";
        $targetFile = $targetDir . basename($imagen);
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFile)) {
            echo json_encode(['success' => false, 'message' => 'Error al subir la imagen']);
            exit;
        }
    }

    // Preparar la consulta
    $stmt = $mysqli->prepare("INSERT INTO resenas (nombre, comentario, imagen) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $nombre, $comentario, $imagen);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Comentario registrado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el comentario']);
    }

    // Cerrar la conexión
    $stmt->close();
    $mysqli->close();
}
?>