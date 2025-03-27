<?php
include("../controladores/conexion.php");

$sql = "SELECT id_nosotros, titulo, descripcion, imagen FROM nosotros";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$tarjetas = [];
while ($row = $result->fetch_assoc()) {
    $tarjetas[] = $row;
}

echo json_encode($tarjetas);

$stmt->close();
$conexion->close();
?>