<?php
include("../controladores/conexion.php");

// Obtener el ID de la propiedad desde la URL
if (isset($_GET['id'])) {
    $id_propiedad = $_GET['id'];

    // Consulta SQL para obtener los detalles de la propiedad
    $query = "SELECT * FROM propiedades WHERE id_propiedad = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_propiedad);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $propiedad = $result->fetch_assoc();
    } else {
        echo "<p>Propiedad no encontrada.</p>";
        exit;
    }
} 
// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($propiedad['titulo']); ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($propiedad['titulo']); ?></h1>
        <img src="../imagenes/<?php echo htmlspecialchars($propiedad['imagen']); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($propiedad['titulo']); ?>">
        <p><?php echo nl2br(htmlspecialchars($propiedad['descripcion'])); ?></p>
        <p><strong>Precio:</strong> $<?php echo htmlspecialchars($propiedad['precio']); ?></p>
        <p><strong>Contacto:</strong> <?php echo htmlspecialchars($propiedad['contacto']); ?></p>
        <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($propiedad['ubicacion']); ?></p>
        <p><strong>Tipo:</strong> <?php echo htmlspecialchars($propiedad['tipo']); ?></p>
        <p><strong>Estado:</strong> <?php echo htmlspecialchars($propiedad['estado']); ?></p>
        <p><strong>Fecha de Publicación:</strong> <?php echo htmlspecialchars($propiedad['fecha_publicacion']); ?></p>
        <a href="../index.php" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>