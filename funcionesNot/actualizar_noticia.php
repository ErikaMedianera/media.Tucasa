<?php
require '../controladores/conexion.php';

// Inicializar respuesta
$response = array('status' => 'error', 'message' => 'Error al procesar la solicitud');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id_noticias']) ? (int)$_POST['id_noticias'] : 0;

    if ($id <= 0) {
        $response['message'] = 'ID de noticia no válido';
        echo json_encode($response);
        exit;
    }

    $camposActualizados = [];
    $valoresActualizados = [];

    if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
        $camposActualizados[] = "titulo = ?";
        $valoresActualizados[] = $_POST['titulo'];
    }
    if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
        $camposActualizados[] = "descripcion = ?";
        $valoresActualizados[] = $_POST['descripcion'];
    }
    if (isset($_POST['fecha_publicacion']) && !empty($_POST['fecha_publicacion'])) {
        $camposActualizados[] = "fecha_publicacion = ?";
        $valoresActualizados[] = $_POST['fecha_publicacion'];
    }

    // Manejar la imagen si se cargó una nueva
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['imagen']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array(strtolower($ext), $allowed)) {
            $nuevo_nombre = uniqid() . '.' . $ext;
            $ruta_destino = '../uploads/' . $nuevo_nombre;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                $camposActualizados[] = "imagen = ?";
                $valoresActualizados[] = $nuevo_nombre;
            } else {
                $response['message'] = 'Error al subir la imagen';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Formato de imagen no permitido. Use JPG, PNG o GIF';
            echo json_encode($response);
            exit;
        }
    }

    if (empty($camposActualizados)) {
        $response['message'] = 'Ningún campo proporcionado para actualizar';
        echo json_encode($response);
        exit;
    }

    $query = "UPDATE noticias SET " . implode(", ", $camposActualizados) . " WHERE id_noticias = ?";
    $valoresActualizados[] = $id;

    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        $response['message'] = 'Error al preparar la consulta: ' . $conexion->error;
        echo json_encode($response);
        exit;
    }

    $tipos = str_repeat('s', count($valoresActualizados));
    $stmt->bind_param($tipos, ...$valoresActualizados);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Noticia actualizada correctamente';
    } else {
        $response['message'] = 'Error al actualizar la noticia: ' . $stmt->error;
    }

    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>