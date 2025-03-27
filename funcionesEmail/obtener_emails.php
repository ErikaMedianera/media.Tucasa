<?php
include("../controladores/conexion.php");

// Establecer el encabezado para devolver JSON
header('Content-Type: application/json');

try {
    // Consulta para obtener los datos de la tabla email
    $query = "SELECT nombre, email, texto FROM email";
    $result = $conexion->query($query);

    if ($result === false) {
        // Si la consulta falla, devolver un error
        echo json_encode(["error" => "Error en la consulta a la base de datos"]);
        exit;
    }

    $emails = [];
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row;
    }

    // Devolver los datos en formato JSON
    echo json_encode($emails);
} catch (Exception $e) {
    // Manejar errores inesperados
    echo json_encode(["error" => $e->getMessage()]);
}

// Cerrar la conexión
$conexion->close();
?>