<?php
include ("../controladores/conexion.php");
// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$comentario = $_POST['comentario'] ?? '';

// Validar que los datos no estén vacíos
if (empty($nombre) || empty($email) || empty($comentario)) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
    exit;
}

// Validar formato de correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "El correo electrónico no es válido."]);
    exit;
}

// Preparar la consulta SQL
$sql = "INSERT INTO resenas (usuario_id, propiedad_id, nombre, comentario) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Asignar valores por defecto para usuario_id y propiedad_id
$usuario_id = 1; // ID de usuario predeterminado (ajusta según tu lógica)
$propiedad_id = 1; // ID de propiedad predeterminado (ajusta según tu lógica)

$stmt->bind_param("iiss", $usuario_id, $propiedad_id, $nombre, $comentario);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Enviar correo electrónico
    $to = "tucorreo@example.com"; // Cambia esto por el correo del destinatario
    $subject = "Nueva Reseña Recibida";
    $message = "Nombre: $nombre\nEmail: $email\nComentario: $comentario";
    $headers = "From: no-reply@example.com"; // Cambia esto por el correo del remitente

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["success" => true, "message" => "Reseña enviada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al enviar el correo electrónico."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Error al guardar la reseña en la base de datos."]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>