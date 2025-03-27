<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controladores/conexion.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    
    // Manejo de la imagen
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen = time() . '_' . $_FILES['imagen']['name'];
        $upload_dir = '../uploads/';
        
        // Crear directorio si no existe
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_dir . $imagen);
    }

    // Consulta SQL
    $query = "INSERT INTO nosotros (titulo, descripcion, imagen) 
              VALUES ('$titulo', '$descripcion', '$imagen')";

    // Ejecutar la consulta
    if ($conexion->query($query) === TRUE) {
        $response = [
            'status' => 'success',
            'message' => 'Propiedad registrada exitosamente!'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al registrar la noticia: ' . $conexion->error
        ];
    }

    // Devolver respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido'
    ]);
}


?>