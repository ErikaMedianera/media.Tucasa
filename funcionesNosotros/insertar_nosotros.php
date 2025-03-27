<?php
require '../controladores/conexion.php';

// Inicializar respuesta
$response = array('status' => 'error', 'message' => 'Error al procesar la solicitud');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
   
    
    // Validar datos
    if (empty($titulo) || empty($descripcion) ) {
        $response['message'] = 'Todos los campos son requeridos';
        echo json_encode($response);
        exit;
    }
    
    // Procesar imagen si existe
    $imagen = 'default.jpg'; // Imagen por defecto
    
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $filename = $_FILES['imagen']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($ext), $allowed)) {
            $nuevo_nombre = uniqid() . '.' . $ext;
            $ruta_destino = '../uploads/' . $nuevo_nombre;
            
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                $imagen = $nuevo_nombre;
            } else {
                $response['message'] = 'Error al subir la imagen';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Formato de imagen no permitido. Use JPG, PNG o GIF';
            echo json_encode($response);
            exit;
        }
    }
    
    // Insertar noticia en la base de datos con sentencia preparada
    $sql = "INSERT INTO nosotros (titulo, descripcion, imagen) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sss", $titulo, $descripcion, $imagen);
        
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Noticia registrada correctamente';
        } else {
            $response['message'] = 'Error al registrar la noticia: ' . $stmt->error;
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