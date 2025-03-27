<?php
// Configuración de la conexión a la base de datos
include("../controladores/conexion.php");

if(isset($_POST['submit'])){
    // Obtener los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

// Manejar la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagenNombre = basename($_FILES['imagen']['name']);
    $rutaImagen = '../uploads/' . $imagenNombre;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
} else {
    $imagenNombre = 'default.jpg'; // Imagen predeterminada si no se sube ninguna
}

// Insertar el servicio en la base de datos
$query = "INSERT INTO servicios (nombre, descripcion, imagen) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param('sss', $nombre, $descripcion, $imagenNombre);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Servicio registrado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al registrar el servicio: ' . $stmt->error]);
}

// Cerrar la conexión
$stmt->close();

}

?>