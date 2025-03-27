<?php
include("../controladores/conexion.php");

// Verificar si se solicita un servicio específico por ID
if (isset($_GET['id'])) {
    $idServicio = $_GET['id'];
    $query = "SELECT * FROM servicios WHERE idServicio = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $idServicio);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $servicio = $result->fetch_assoc();
        echo json_encode($servicio);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Servicio no encontrado']);
    }
} else {
    // Obtener todos los servicios
    $query = "SELECT * FROM servicios";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $servicios = [];
        while ($row = $result->fetch_assoc()) {
            $servicios[] = $row;
        }
        echo json_encode($servicios);
    } else {
        echo json_encode([]);
    }
}

// Cerrar la conexión

?>