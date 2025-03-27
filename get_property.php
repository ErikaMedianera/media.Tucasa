<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Iniciar buffer de salida
ob_start();

// Verificar si el archivo de conexión existe
if (!file_exists('../controladores/conexion.php')) {
    ob_clean();
    echo json_encode([
        'status' => 'error',
        'message' => 'Archivo de conexión no encontrado'
    ]);
    exit();
}

require_once '../controladores/conexion.php';

// Verificar la conexión
if (!isset($sql) || $sql->connect_error) {
    ob_clean();
    echo json_encode([
        'status' => 'error',
        'message' => 'Error de conexión a la base de datos'
    ]);
    exit();
}

try {
    // Verificar si se proporcionó un ID
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception('ID de propiedad no proporcionado');
    }

    $id = intval($_GET['id']);
    
    // Preparar y ejecutar la consulta
    $query = "SELECT * FROM propiedades WHERE id_propiedad = ?";
    $stmt = $sql->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta: ' . $sql->error);
    }
    
    $stmt->bind_param('i', $id);
    
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception('No se encontró la propiedad con ID: ' . $id);
    }
    
    $propiedad = $result->fetch_assoc();
    
    // Limpiar cualquier salida anterior
    ob_clean();
    
    // Enviar respuesta exitosa
    echo json_encode([
        'status' => 'success',
        'propiedad' => $propiedad
    ]);

} catch (Exception $e) {
    // Limpiar cualquier salida anterior
    ob_clean();
    
    // Enviar respuesta de error
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}

// Asegurar que no haya más salida después
exit();
?>