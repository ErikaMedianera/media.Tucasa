<?php
include '../controladores/conexion.php';

// Consulta SQL para obtener los datos de la tabla "noticias"
$sql = "SELECT * FROM noticias ORDER BY fecha_publicacion DESC";
$resultado = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die(json_encode(['error' => 'Error en la consulta: ' . $conexion->error]));
}

// Crear un array para almacenar las noticias
$noticias = array();
while ($fila = $resultado->fetch_assoc()) {
    $noticias[] = $fila;
}

// Devolver los datos en formato JSON
echo json_encode($noticias);
?>