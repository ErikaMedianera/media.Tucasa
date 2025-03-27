<?php
include '../controladores/conexion.php';

$buscar = $_POST['buscar'] ?? '';

$query = "SELECT id_propiedad, imagen, titulo, descripcion, precio, ubicacion, contacto, tipo, estado FROM propiedades WHERE 
    precio LIKE '%$buscar%' OR 
    tipo LIKE '%$buscar%' OR 
    estado LIKE '%$buscar%' OR 
    ubicacion LIKE '%$buscar%'";

$result = $conexion->query($query);
$propiedades = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $propiedades[] = $row;
    }
}

echo json_encode($propiedades);

$conexion->close();
?>