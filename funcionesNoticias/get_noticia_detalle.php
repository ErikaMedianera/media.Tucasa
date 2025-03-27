<?php
include '../controladores/conexion.php';

// Obtener el ID de la noticia desde la URL
$id_noticia = $_GET['id'];

// Consulta SQL para obtener los datos de la noticia específica
$sql = "SELECT * FROM noticias WHERE id_noticias = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_noticia);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si la consulta fue exitosa
if ($resultado->num_rows > 0) {
    $noticia = $resultado->fetch_assoc();
    echo json_encode($noticia);
} else {
    echo json_encode(['error' => 'No se encontró la noticia']);
}

$stmt->close();
$conexion->close();
?>