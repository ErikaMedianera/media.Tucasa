<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/desNoticias.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Detalle de Noticia</title>
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
  <!--FIN DE LA PARTE DEL HEADER-->

<div class="container-fluid titulo">
    <h1 id="titulo-noticia">Titulo de la noticia</h1>
</div>
<div class="container-fluid">
    <div class="contenedor-contexto">
        <h6 id="descripcion-noticia">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, delectus!</h6>
        <img id="imagen-noticia" src="../imagenes/comprimidos.webp" alt="">
    </div>
    <div class="contenedor-desarrollo">
        <h2>Subtitulo</h2>
        <p id="contenido-noticia">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti optio, suscipit itaque aspernatur hic quasi, voluptatum similique, adipisci doloribus porro ipsum placeat nesciunt
            voluptas nostrum quae. Temporibus ea corporis perferendis!
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non sit corporis optio amet distinctio eveniet fuga, autem ullam suscipit commodi quia harum! Laudantium
            culpa exercitationem consequuntur facere expedita inventore facilis.
        </p>
    </div>
</div>

<!--PARTE DEL FOOTER-->

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

<script src="../js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const idNoticia = urlParams.get('id');

    if (idNoticia) {
        // Realizar una solicitud AJAX para obtener los detalles de la noticia
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `../funcionesNoticias/get_noticia_detalle.php?id=${idNoticia}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const noticia = JSON.parse(xhr.responseText);
                    if (noticia.error) {
                        Swal.fire('Error', noticia.error, 'error');
                    } else {
                        document.getElementById('titulo-noticia').textContent = noticia.titulo;
                        document.getElementById('descripcion-noticia').textContent = noticia.descripcion;
                        document.getElementById('imagen-noticia').src = `../../admin/uploads/${noticia.imagen}`;
                        document.getElementById('contenido-noticia').textContent = noticia.contenido;
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response:', xhr.responseText);
                    Swal.fire('Error', 'Error al cargar los detalles de la noticia', 'error');
                }
            } else {
                Swal.fire('Error', 'Error al cargar los detalles de la noticia', 'error');
            }
        };
        xhr.send();
    } else {
        Swal.fire('Error', 'No se proporcionó un ID de noticia válido', 'error');
    }
});
</script>
</body>
</html>