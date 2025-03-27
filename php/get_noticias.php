<?php
include '../controladores/conexion.php';

// Consulta SQL para obtener los datos de la tabla "noticias"
$sql = "SELECT * FROM noticias";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Crear un array para almacenar las noticias
$noticias = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $noticias[] = $fila;
}

// Devolver los datos en formato JSON
echo json_encode($noticias);
?>