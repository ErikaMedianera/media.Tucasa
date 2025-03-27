<?php
require '../controladores/conexion.php';

// Inicializar respuesta
$response = array('status' => 'error', 'message' => 'Error al procesar la solicitud');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idServicio = isset($_POST['idServicioActualizar']) ? (int)$_POST['idServicioActualizar'] : 0;

    if ($idServicio <= 0) {
        $response['message'] = 'ID de servicio no válido';
        echo json_encode($response);
        exit;
    }

    $camposActualizados = [];
    $valoresActualizados = [];

    if (isset($_POST['tituloActualizar']) && !empty($_POST['tituloActualizar'])) {
        $camposActualizados[] = "titulo = ?";
        $valoresActualizados[] = $_POST['tituloActualizar'];
    }
    if (isset($_POST['descripcionActualizar']) && !empty($_POST['descripcionActualizar'])) {
        $camposActualizados[] = "descripcion = ?";
        $valoresActualizados[] = $_POST['descripcionActualizar'];
    }

    // Manejar la imagen si se cargó una nueva
    if (isset($_FILES['imagenActualizar']) && $_FILES['imagenActualizar']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['imagenActualizar']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array(strtolower($ext), $allowed)) {
            $nuevo_nombre = uniqid() . '.' . $ext;
            $ruta_destino = '../uploads/' . $nuevo_nombre;

            if (move_uploaded_file($_FILES['imagenActualizar']['tmp_name'], $ruta_destino)) {
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

    $query = "UPDATE servicios SET " . implode(", ", $camposActualizados) . " WHERE idServicio = ?";
    $valoresActualizados[] = $idServicio;

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
        $response['message'] = 'Servicio actualizado correctamente';
    } else {
        $response['message'] = 'Error al actualizar el servicio: ' . $stmt->error;
    }

    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>