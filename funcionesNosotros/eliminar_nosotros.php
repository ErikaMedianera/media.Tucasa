<?php
// Database connection configuration


// Set charset to UTF-8


// Delete record
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    
    // Get image filename to delete
    $stmt = $conexion->prepare("SELECT imagen FROM nosotros WHERE id = ?");
    if (!$stmt) {
        echo json_encode(array("status" => "error", "message" => "Error en la preparación de la consulta: " . $conexion->error));
        exit;
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $image = $row['imagen'];
        if (!empty($image) && file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
    }
    $stmt->close();
    
    // Delete record
    $stmt = $conexion->prepare("DELETE FROM nosotros WHERE id = ?");
    if (!$stmt) {
        echo json_encode(array("status" => "error", "message" => "Error en la preparación de la consulta: " . $conexion->error));
        exit;
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Registro eliminado exitosamente."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al eliminar el registro: " . $stmt->error));
    }
    
    $stmt->close();
    exit;
}

// Close connection

?>