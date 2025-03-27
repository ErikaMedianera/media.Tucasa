<?php
include '../controladores/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_servicio = $_POST['id'];

    // Validar los datos
    if (empty($id_servicio)) {
        echo json_encode(['status' => 'error', 'message' => 'ID de servicio no proporcionado']);
        exit;
    }

    // Eliminar la información en la base de datos
    $stmt = $conexion->prepare("DELETE FROM servicios WHERE idServicio = ?");
    $stmt->bind_param("i", $id_servicio);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el servicio']);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido']);
}
?>