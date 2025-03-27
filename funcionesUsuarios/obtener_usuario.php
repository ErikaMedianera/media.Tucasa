<?php
// Configuración de la conexión a la base de datos
include("../controladores/conexion.php");
// Consulta preparada para obtener todos los usuarios
$sql = "SELECT nombre, email, contraseña FROM usuarios";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode(['success' => true, 'data' => $usuarios]);

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>