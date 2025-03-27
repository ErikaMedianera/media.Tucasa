<?php
include("../controladores/conexion.php");
// Verificar si se recibió la acción correcta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'obtener_propiedades') {
    // Consulta SQL para obtener las propiedades
    $query = "SELECT id_propiedad, titulo, descripcion, imagen FROM propiedades";
    $result = $conexion->query($query);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        $propiedades = [];
        while ($row = $result->fetch_assoc()) {
            $propiedades[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $propiedades]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron propiedades.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
}

// Cerrar la conexión
$conexion->close();
?>