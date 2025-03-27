<?php
include("../controladores/conexion.php");
// Consultar el total de usuarios
$sql_usuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
$result_usuarios = $conexion->query($sql_usuarios);
$total_usuarios = $result_usuarios->fetch_assoc()["total_usuarios"];

// Consultar el total de propiedades disponibles
$sql_disponibles = "SELECT COUNT(*) AS propiedades_disponibles FROM propiedades WHERE estado = 'Disponible'";
$result_disponibles = $conexion->query($sql_disponibles);
$propiedades_disponibles = $result_disponibles->fetch_assoc()["propiedades_disponibles"];

// Consultar el total de propiedades ocupadas
$sql_ocupadas = "SELECT COUNT(*) AS propiedades_ocupadas FROM propiedades WHERE estado = 'Ocupado'";
$result_ocupadas = $conexion->query($sql_ocupadas);
$propiedades_ocupadas = $result_ocupadas->fetch_assoc()["propiedades_ocupadas"];

// Consultar el total de propiedades
$sql_total_propiedades = "SELECT COUNT(*) AS total_propiedades FROM propiedades";
$result_total_propiedades = $conexion->query($sql_total_propiedades);
$total_propiedades = $result_total_propiedades->fetch_assoc()["total_propiedades"];

// Consultar los datos para la tabla
$sql_tabla = "SELECT tipo, contacto, precio, estado, fecha_publicacion FROM propiedades";
$result_tabla = $conexion->query($sql_tabla);

// Generar el HTML de la tabla
$tabla_html = "";
if ($result_tabla->num_rows > 0) {
    while ($row = $result_tabla->fetch_assoc()) {
        $tabla_html .= "<tr>";
        $tabla_html .= "<td>" . htmlspecialchars($row['tipo']) . "</td>";
        $tabla_html .= "<td>" . htmlspecialchars($row['contacto']) . "</td>";
        $tabla_html .= "<td>$" . number_format($row['precio'], 2) . "</td>";
        $tabla_html .= "<td>" . htmlspecialchars($row['estado']) . "</td>";
        $tabla_html .= "<td>" . htmlspecialchars($row['fecha_publicacion']) . "</td>";
        $tabla_html .= "</tr>";
    }
} else {
    $tabla_html .= "<tr><td colspan='5' class='text-center'>No hay propiedades disponibles.</td></tr>";
}

// Cerrar la conexión
$conexion->close();

// Devolver los datos como JSON
echo json_encode([
    "total_usuarios" => $total_usuarios,
    "propiedades_disponibles" => $propiedades_disponibles,
    "propiedades_ocupadas" => $propiedades_ocupadas,
    "total_propiedades" => $total_propiedades,
    "tabla_html" => $tabla_html,
]);
?>