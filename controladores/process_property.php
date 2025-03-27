<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Iniciar buffer de salida
ob_start();

try {
    // Verificar si el archivo de conexión existe
    if (!file_exists('conexion.php')) {
        throw new Exception('Archivo de conexión no encontrado');
    }

    require_once 'conexion.php';

    // Verificar la conexión
    if (!isset($sql) || $sql->connect_error) {
        throw new Exception('Error de conexión a la base de datos: ' . $sql->connect_error);
    }

    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    // Obtener los datos del formulario
    $id_propiedad = isset($_POST['id_propiedad']) ? trim($_POST['id_propiedad']) : '';
    $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
    $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
    $ubicacion = isset($_POST['ubicacion']) ? trim($_POST['ubicacion']) : '';
    $contacto = isset($_POST['contacto']) ? trim($_POST['contacto']) : '';
    $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
    $fecha_publicacion = isset($_POST['fecha_publicacion']) ? trim($_POST['fecha_publicacion']) : '';

    // Validar campos requeridos
    if (empty($titulo) || empty($descripcion) || empty($ubicacion) || 
        empty($contacto) || empty($tipo) || empty($estado) || empty($fecha_publicacion)) {
        throw new Exception('Todos los campos son requeridos');
    }

    // Variable para almacenar el nombre de la imagen
    $imagen_nombre = '';

    // Procesar la imagen si se ha subido una nueva
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen'];
        $imagen_tipo = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));
        
        // Validar tipo de archivo
        $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imagen_tipo, $tipos_permitidos)) {
            throw new Exception('Tipo de archivo no permitido. Solo se permiten: ' . implode(', ', $tipos_permitidos));
        }

        // Crear directorio si no existe
        $directorio_destino = "../uploads/";
        if (!file_exists($directorio_destino)) {
            if (!mkdir($directorio_destino, 0777, true)) {
                throw new Exception('Error al crear el directorio de uploads');
            }
        }

        // Generar nombre único para la imagen
        $imagen_nombre = uniqid() . '_' . time() . '.' . $imagen_tipo;
        $ruta_destino = $directorio_destino . $imagen_nombre;

        // Mover el archivo
        if (!move_uploaded_file($imagen['tmp_name'], $ruta_destino)) {
            throw new Exception('Error al subir la imagen');
        }
    }

    // Preparar la consulta según sea inserción o actualización
    if (empty($id_propiedad)) {
        // Es una nueva propiedad
        if (empty($imagen_nombre)) {
            throw new Exception('La imagen es requerida para nuevas propiedades');
        }

        $query = "INSERT INTO propiedades (titulo, descripcion, precio, ubicacion, contacto, tipo, estado, fecha_publicacion, imagen) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $sql->prepare($query);
        
        if (!$stmt) {
            throw new Exception('Error al preparar la consulta: ' . $sql->error);
        }
        
        $stmt->bind_param('ssdsssss', $titulo, $descripcion, $precio, $ubicacion, $contacto, $tipo, $estado, $fecha_publicacion, $imagen_nombre);
    } else {
        // Es una actualización
        if (!empty($imagen_nombre)) {
            // Si hay nueva imagen, actualizar también la imagen
            $query = "UPDATE propiedades SET 
                     titulo = ?, descripcion = ?, precio = ?, ubicacion = ?, 
                     contacto = ?, tipo = ?, estado = ?, fecha_publicacion = ?, 
                     imagen = ? WHERE id_propiedad = ?";
            $stmt = $sql->prepare($query);
            
            if (!$stmt) {
                throw new Exception('Error al preparar la consulta: ' . $sql->error);
            }
            
            $stmt->bind_param('ssdssssssi', $titulo, $descripcion, $precio, $ubicacion, 
                            $contacto, $tipo, $estado, $fecha_publicacion, $imagen_nombre, $id_propiedad);

            // Eliminar la imagen anterior
            $query_img = "SELECT imagen FROM propiedades WHERE id_propiedad = ?";
            $stmt_img = $sql->prepare($query_img);
            $stmt_img->bind_param('i', $id_propiedad);
            $stmt_img->execute();
            $result_img = $stmt_img->get_result();
            
            if ($row_img = $result_img->fetch_assoc()) {
                $imagen_anterior = "../uploads/" . $row_img['imagen'];
                if (file_exists($imagen_anterior)) {
                    unlink($imagen_anterior);
                }
            }
        } else {
            // Si no hay nueva imagen, actualizar sin la imagen
            $query = "UPDATE propiedades SET 
                     titulo = ?, descripcion = ?, precio = ?, ubicacion = ?, 
                     contacto = ?, tipo = ?, estado = ?, fecha_publicacion = ? 
                     WHERE id_propiedad = ?";
            $stmt = $sql->prepare($query);
            
            if (!$stmt) {
                throw new Exception('Error al preparar la consulta: ' . $sql->error);
            }
            
            $stmt->bind_param('ssdsssssi', $titulo, $descripcion, $precio, $ubicacion, 
                            $contacto, $tipo, $estado, $fecha_publicacion, $id_propiedad);
        }
    }

    // Ejecutar la consulta
    if (!$stmt->execute()) {
        throw new Exception('Error al guardar la propiedad: ' . $stmt->error);
    }

    // Limpiar cualquier salida anterior
    ob_clean();
    
    // Enviar respuesta exitosa
    echo json_encode([
        'status' => 'success',
        'message' => empty($id_propiedad) ? 'Propiedad registrada correctamente' : 'Propiedad actualizada correctamente'
    ]);

} catch (Exception $e) {
    // Limpiar cualquier salida anterior
    ob_clean();
    
    // Si se subió una imagen y hubo error, eliminarla
    if (!empty($imagen_nombre) && file_exists("../uploads/" . $imagen_nombre)) {
        unlink("../uploads/" . $imagen_nombre);
    }
    
    // Enviar respuesta de error
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}

// Asegurar que no haya más salida después
exit(); 