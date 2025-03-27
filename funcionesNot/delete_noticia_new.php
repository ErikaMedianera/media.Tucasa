<?php
require '../controladores/conexion.php';

// Inicializar respuesta
$response = array('status' => 'error', 'message' => 'Error al procesar la solicitud');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener ID de la noticia a eliminar
    $id = isset($_POST['id_noticias']) ? (int)$_POST['id_noticias'] : 0;
    
    if ($id <= 0) {
        $response['message'] = 'ID de noticia no válido';
        echo json_encode($response);
        exit;
    }
    
    // Primero obtenemos el nombre de la imagen para eliminarla del servidor
    $sql_imagen = "SELECT imagen FROM noticias WHERE id_noticias = ?";
    $stmt_imagen = $conexion->prepare($sql_imagen);
    
    if ($stmt_imagen) {
        $stmt_imagen->bind_param("i", $id);
        $stmt_imagen->execute();
        $resultado = $stmt_imagen->get_result();
        
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $imagen = $fila['imagen'];
            
            // No eliminar la imagen por defecto
            if ($imagen != 'default.jpg') {
                $ruta_imagen = '../uploads/' . $imagen;
                if (file_exists($ruta_imagen)) {
                    unlink($ruta_imagen);
                }
            }
        }
        
        $stmt_imagen->close();
    }
    
    // Eliminar la noticia de la base de datos
    $sql = "DELETE FROM noticias WHERE id_noticias = ?";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Noticia eliminada correctamente';
        } else {
            $response['message'] = 'Error al eliminar la noticia: ' . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $response['message'] = 'Error en la preparación de la consulta: ' . $conexion->error;
    }
}

// Devolver respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>