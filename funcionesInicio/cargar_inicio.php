<?php
include("../controladores/conexion.php");
// Consulta con sentencia preparada
$sql = "SELECT tipo, fecha_publicacion, estado, precio FROM propiedades";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Generar el HTML de la tabla
$output = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>";
        $output .= "<td>" . htmlspecialchars($row['tipo']) . "</td>";
        $output .= "<td>" . htmlspecialchars($row['fecha_publicacion']) . "</td>";
        $output .= "<td>" . htmlspecialchars($row['estado']) . "</td>";
        $output .= "<td>$" . number_format($row['precio'], 2) . "</td>";
        $output .= "</tr>";
    }
} else {
    $output .= "<tr><td colspan='4' class='text-center'>No hay propiedades disponibles.</td></tr>";
}

// Cerrar la conexión
$stmt->close();
$conexion->close();

// Devolver el HTML
echo $output;
?>