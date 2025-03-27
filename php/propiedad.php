<?php
include '../controladores/conexion.php';

// Obtener el ID de la propiedad desde la URL
$id_propiedad = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta SQL para obtener los detalles de la propiedad
$sql_propiedad = "SELECT id_propiedad, titulo, descripcion, imagen, precio, ubicacion, contacto, tipo, estado, fecha_publicacion FROM propiedades WHERE id_propiedad = $id_propiedad";
$resultado_propiedad = mysqli_query($conexion, $sql_propiedad);

// Verificar si la consulta fue exitosa
if (!$resultado_propiedad) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Obtener los datos de la propiedad
$propiedad = mysqli_fetch_assoc($resultado_propiedad);
if (!$propiedad) {
    die("Propiedad no encontrada.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/propiedad.css">
    <title>Detalles de la Propiedad</title>
    <style>
        .seccion-imagen img {
            width: 100%;
            height: auto;
            max-height: 400px; /* Ajusta este valor según tus necesidades */
            object-fit: cover;
        }
    </style>
</head>
<body>

   <!--COMIENZO DE LA PARTE DEL HEADER-->
   <header class="encabezado">
       
       <nav class="navbar navbar-expand-lg bg-body-tertiary ">
     <div class="container-fluid">
       <a class="navbar-brand logo" href="#"><span class="tu">Tu</span>Casa</a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse  navegacion" id="navbarNavDropdown">
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
           <li class="nav-item dropdown">
            
             <div class="search-container">
                <button class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input type="text" class="search-input" placeholder="Buscar...">
               </div>
           </li>
         </ul>
       </div>
     </div>
   </nav>
   </nav>
           
  </header> 
  <!--FIN DEL HEADER--->

<!--COMIENZO DE DETALLE DE PROPIEDADES-->
<div class="secciones">
    <section class="secciones-texto">
        <h4><?php echo htmlspecialchars($propiedad['titulo']); ?></h4>
        <p class="lorem-text"><?php echo htmlspecialchars($propiedad['descripcion']); ?></p>
        <h5>Detalles</h5>
        <div class="listas">
            <ul>
                <li><strong>Precio:</strong> <?php echo htmlspecialchars($propiedad['precio']); ?></li>
                <li><strong>Ubicación:</strong> <?php echo htmlspecialchars($propiedad['ubicacion']); ?></li>
                <li><strong>Contacto:</strong> <?php echo htmlspecialchars($propiedad['contacto']); ?></li>
                <li><strong>Tipo:</strong> <?php echo htmlspecialchars($propiedad['tipo']); ?></li>
                <li><strong>Estado:</strong> <?php echo htmlspecialchars($propiedad['estado']); ?></li>
                <li><strong>Fecha de Publicación:</strong> <?php echo htmlspecialchars($propiedad['fecha_publicacion']); ?></li>
            </ul>
        </div>
        <button class="btn btn-primary">Ver imágenes</button>
    </section>

    <section class="seccion-imagen">
        <img src="../../admin/uploads/<?php echo htmlspecialchars($propiedad['imagen']); ?>" alt="<?php echo htmlspecialchars($propiedad['titulo']); ?>">
    </section>
</div>
<!--FIN DE SECCION DE DETALLE DE PROPIEDADES-->

<div class="sociales">
    <div class="icono">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <h6>Facebook</h6>
    </div>
    <div class="icono">
        <a href="#"><i class="fab fa-twitter"></i></a>
        <h6>Twitter</h6>
    </div>
    <div class="icono">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <h6>Instagram</h6>
    </div>
    <div class="icono">
        <a href="#"><i class="fab fa-youtube"></i></a>
        <h6>YouTube</h6>
    </div>
</div>
<div class="container-fluit mapa">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127607.51981149847!2d9.692832671629803!3d1.8516487695768342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x107cf975f426f005%3A0x1fb510ca7f0558c6!2sBata%2C%20Guinea%20Ecuatorial!5e0!3m2!1ses!2s!4v1739532184384!5m2!1ses!2s" 
        width="100%" 
        height="300" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

 <footer>
      <div class="container-fluid footer">
        <div class="footers">
        <a href="">Inicio</a>
        <a href="">Servicios</a>
        <a href="">Contcatoc</a>
        <a href="">Nosotros</a>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, dicta?</p>
      </div>
    </footer>
    <!--FIN DE LA PARTE DEL FOOTER-->
    <script src="../js/input.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>