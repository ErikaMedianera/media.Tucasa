<?php
require '../controladores/conexion.php';

// Inicializar respuesta
$response = array();

// Verificar si se está solicitando una noticia específica
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Preparar consulta para una noticia específica
    $sql = "SELECT * FROM nosotros WHERE id_nosotros = ?";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            $noticia = $resultado->fetch_assoc();
            $response = $noticia;
        } else {
            $response = array('status' => 'error', 'message' => 'Noticia no encontrada');
        }
        
        $stmt->close();
    } else {
        $response = array('status' => 'error', 'message' => 'Error en la consulta: ' . $conexion->error);
    }
} else {
    // Obtener todas las noticias ordenadas por fecha de publicación
    $sql = "SELECT * FROM nosotros ORDER BY titulo DESC";
    $resultado = $conexion->query($sql);
    
    if ($resultado) {
        $noticias = array();
        
        while ($fila = $resultado->fetch_assoc()) {
            $noticias[] = $fila;
        }
        
        $response = $noticias;
    } else {
        $response = array('status' => 'error', 'message' => 'Error al obtener las noticias: ' . $conexion->error);
    }
}

// Devolver respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>