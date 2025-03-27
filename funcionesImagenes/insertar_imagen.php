<?php
include("../controladores/conexion.php");
// Verificar si se han recibido datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen']) && isset($_POST['id_noticias']) && isset($_POST['id_propiedad'])) {
    
    // Obtener los datos del formulario
    $id_noticias = $_POST['id_noticias'];
    $id_propiedad = $_POST['id_propiedad'];
    
    // Subir la imagen al servidor
    $imagen = $_FILES['imagen']['name'];
    $ruta_imagen = 'uploads/' . basename($imagen);
    
    // Mover la imagen a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        
        // Preparar la sentencia SQL para insertar los datos
        $stmt = $conexion->prepare("INSERT INTO imagenes (id_noticias, id_propiedad, ruta_imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id_noticias, $id_propiedad, $ruta_imagen);

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            echo "success"; // Respuesta exitosa
        } else {
            echo "error"; // Respuesta con error
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "error"; // Error al mover la imagen
    }
} else {
    echo "error"; // Datos no recibidos correctamente
}

// Cerrar la conexión
$conexion->close();
?>