<?php
include '../controladores/conexion.php';

// Obtener datos de casas por estado
$query_estado = "SELECT estado, COUNT(*) as total FROM propiedades GROUP BY estado";
$resultado_estado = mysqli_query($conexion, $query_estado);
$casas_por_estado = [];
while ($fila = mysqli_fetch_assoc($resultado_estado)) {
    $casas_por_estado[] = $fila;
}

// Obtener datos de casas por tipo
$query_tipo = "SELECT tipo, COUNT(*) as total FROM propiedades GROUP BY tipo";
$resultado_tipo = mysqli_query($conexion, $query_tipo);
$casas_por_tipo = [];
while ($fila = mysqli_fetch_assoc($resultado_tipo)) {
    $casas_por_tipo[] = $fila;
}

mysqli_close($conexion);

echo json_encode([
    'casas_por_estado' => $casas_por_estado,
    'casas_por_tipo' => $casas_por_tipo
]);
?>