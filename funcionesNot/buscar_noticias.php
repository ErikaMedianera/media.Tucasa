<?php
include '../controladores/conexion.php';

$query = $_POST['query'] ?? '';

$sql = "SELECT id_noticia, imagen, titulo, descripcion, fecha_publicacion FROM noticias WHERE titulo LIKE ? OR fecha_publicacion LIKE ?";
$stmt = $conexion->prepare($sql);
$search = "%$query%";
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
$noticias = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $noticias[] = $row;
    }
}

echo json_encode($noticias);

$stmt->close();
$conexion->close();
?>