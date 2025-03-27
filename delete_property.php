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
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    // Obtener y decodificar los datos JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!isset($data['id']) || empty($data['id'])) {
        throw new Exception('ID de propiedad no proporcionado');
    }

    $id = intval($data['id']);

    // Primero, obtener la información de la imagen
    $query = "SELECT imagen FROM propiedades WHERE id_propiedad = ?";
    $stmt = $sql->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta de imagen: ' . $sql->error);
    }
    
    $stmt->bind_param('i', $id);
    
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta de imagen: ' . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagen = $row['imagen'];
        
        // Eliminar el archivo de imagen si existe
        $ruta_imagen = "../uploads/" . $imagen;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
    }
    
    // Preparar y ejecutar la consulta de eliminación
    $query = "DELETE FROM propiedades WHERE id_propiedad = ?";
    $stmt = $sql->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta de eliminación: ' . $sql->error);
    }
    
    $stmt->bind_param('i', $id);
    
    if (!$stmt->execute()) {
        throw new Exception('Error al eliminar la propiedad: ' . $stmt->error);
    }
    
    if ($stmt->affected_rows === 0) {
        throw new Exception('No se encontró la propiedad con ID: ' . $id);
    }
    
    // Limpiar cualquier salida anterior
    ob_clean();
    
    // Enviar respuesta exitosa
    echo json_encode([
        'status' => 'success',
        'message' => 'Propiedad eliminada correctamente'
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