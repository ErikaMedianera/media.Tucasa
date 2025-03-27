<?php
include '../controladores/conexion.php';

// Consulta SQL para obtener los datos de la tabla "nosotros"
$sql = "SELECT * FROM nosotros";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/nosotros.css">
    <title>Nosotros</title>
</head>
<body>

<!-- COMIENZO DEL HEADER -->
<header class="encabezado">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="#"><span class="tu">Tu</span>Casa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navegacion" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pruebacasas.php">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./nosotros.php">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contactos.php">Contactos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./noticia.php">Noticias</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- FIN DEL HEADER -->

<!-- Sección de Contenidos -->
<div class="container-fluid">
    <div class="contenidos">
        <!-- Sección Quienes Somos -->
        <section class="seccion-img">
            <div class="imagen">
                <img src="../imagenes/3.jpeg" alt="">
            </div>
        </section>

        <section class="seccion-cntenido">
            <h3>QUIENES SOMOS?</h3>
            <p id="resumen">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est eaque maxime officiis commodi accusantium debitis minus laborum ipsa nihil molestiae sequi mollitia, perspiciatis quisquam. Provident nostrum enim accusamus? Dicta, nihil.</p>
            <button class="btn btn-outline" id="btn-mas-detalles">Más detalles</button>

            <!-- Contenido adicional oculto -->
            <div id="mas-detalles" style="display: none;">
                <h3>NUESTRA VISION</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, quod. Quibusdam, voluptate voluptatum. Nesciunt, quae. Dolores, quibusdam. Quisquam, quae. Dolores, quibusdam. Quisquam, quae.</p>
                <p>Además, somos una empresa comprometida con la calidad y la satisfacción del cliente. Ofrecemos soluciones inmobiliarias innovadoras para todas tus necesidades.</p>
            </div>
        </section>
    </div>

    <!-- CARPETAS DE NUESTRA EMPRESA -->
    <div class="tarjetas-personal" id="tarjetas-container">
        <?php
        // Generar tarjetas dinámicamente
        if (mysqli_num_rows($resultado) > 0) {
            while ($noticia = mysqli_fetch_assoc($resultado)) {
                // Validar y normalizar la ruta de la imagen
                $imagen_ruta = !empty($noticia['imagen']) ? trim($noticia['imagen']) : 'default.jpg';
                $ruta_completa = "../../admin/uploads/" . $imagen_ruta;

                // Verificar si la imagen existe en el servidor
                $ruta_absoluta = $_SERVER['DOCUMENT_ROOT'] . "/TuCasa.com/admin/uploads/" . $imagen_ruta;
                if (!file_exists($ruta_absoluta)) {
                    $ruta_completa = "../../admin/uploads/default.jpg"; // Usar imagen predeterminada si no existe
                }

                // Generar la tarjeta
                echo '
                <div class="card tarjeta" style="width: 15rem;">
                    <img src="' . htmlspecialchars($ruta_completa) . '" class="card-img-top" alt="' . htmlspecialchars($noticia['titulo']) . '">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($noticia['titulo']) . '</h5>
                        <p class="card-text">' . htmlspecialchars($noticia['descripcion']) . '</p>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No hay contenido disponible.</p>';
        }
        
        ?>
    </div>
</div>
<!-- FIN Sección de Contenidos -->

<!-- PARTE DEL FOOTER -->
<footer>
    <div class="container-fluid footer">
        <div class="footers">
            <a href="../index.php">Inicio</a>
            <a href="./pruebacasas.php">Servicios</a>
            <a href="./contactos.php">Contacto</a>
            <a href="./nosotros.php">Nosotros</a>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, dicta?</p>
    </div>
</footer>
<!-- FIN DE LA PARTE DEL FOOTER -->

<script src="../js/bootstrap.min.js"></script>
<script src="../js/sweetalert2.js"></script>
<script>
// Mostrar/Ocultar más detalles
document.getElementById("btn-mas-detalles").addEventListener("click", function () {
    const masDetalles = document.getElementById("mas-detalles");
    if (masDetalles.style.display === "none") {
        masDetalles.style.display = "block";
        this.textContent = "Ocultar detalles"; // Cambiar texto del botón
    } else {
        masDetalles.style.display = "none";
        this.textContent = "Más detalles"; // Restaurar texto del botón
    }
});
</script>
</body>
</html>