<?php
include("../controladores/conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir el ID a un entero para mayor seguridad

    // Actualizar la consulta para usar id_resena
    $query = "SELECT imagen, nombre, comentario FROM resenas WHERE id_resena = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Reseña no encontrada.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado.']);
}

$conexion->close();
?>