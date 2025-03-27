<?php


include("../controladores/conexion.php");
// Set charset to UTF-8
$conexion->set_charset("utf8");

// Fetch single record
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'getOne') {
    $id = $_GET['id'];
    
    $stmt = $conexion->prepare("SELECT * FROM nosotros WHERE id = ?");
    if (!$stmt) {
        echo json_encode(array("status" => "error", "message" => "Error en la preparación de la consulta: " . $conexion->error));
        exit;
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(array("status" => "error", "message" => "Registro no encontrado."));
    }
    
    $stmt->close();
    exit;
}

// Close connection
$conexion->close();
?>