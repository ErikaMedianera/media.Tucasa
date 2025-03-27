<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/noticia.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Noticias</title>
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

<div class="container-fluid">
    <div class="container">
        <div class="row lineas-noticias">
            <div class="col-md-10 lineas-noticias-texto">
                <h2>Noticias recientes</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nostrum quis temporibus
                    a repudiandae provident doloribus doloremque quaerat quas quasi.
                </p>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Ver mas</button>
            </div>
        </div>
    </div>
    <!--COMIENZO DE LA PARTE DE TARJETAS DE NOTICIAS-->
    <div class="container tarjetas-noticias" id="noticias-container">
        <!-- Las tarjetas de noticias se cargarán aquí dinámicamente -->
    </div>
    <!--FIN DE LA PARTE DE TARJETAS DE NOTICIAS-->

    <!-- Carrusel de noticias recientes (movido debajo de las tarjetas) -->
    <div id="carouselNoticiasRecientes" class="carousel carousel-dark slide mt-4">
        <div class="carousel-indicators" id="carousel-indicators-recientes">
            <!-- Indicadores dinámicos -->
        </div>
        <div class="carousel-inner" id="carousel-inner-recientes">
            <!-- Noticias recientes dinámicas -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselNoticiasRecientes" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselNoticiasRecientes" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Fin del carrusel de noticias recientes -->

    <!--comienzo de noticias en linea-->
    <div class="container-fluid columnas-noticias">
        <div class="row">
            <div class="col-md-3">
                <h3>Noticias</h3>
                <a href=""><i class="fa-solid fa-caret-left"></i> <span>Lorem ipsum dolor sit.</span></a>
                <a href=""><i class="fa-solid fa-caret-left"></i> <span>Lorem ipsum dolor sit.</span></a>
                <a href=""><i class="fa-solid fa-caret-left"></i> <span>Lorem ipsum dolor sit.</span></a>
                <a href=""><i class="fa-solid fa-caret-left"></i> <span>Lorem ipsum dolor sit.</span></a>
            </div>
            <div class="col-md-5">
                <p style="color: #444;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae blanditiis labore velit reiciendis, id distinctio nulla voluptate amet. Rerum nesciunt, quibusdam perspiciatis illum 
                    nulla architecto corporis quas tempora culpa doloribus!
                </p>
                <div class="contadores">
                    <h2><span><p>1</p></span></h2>
                    <h2><span>50%</span></h2>
                    <h2><span>50%</span></h2>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Nuestros Clientes</h2>
                <div class="textos-clientes">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ratione nesciunt provident neque unde! Atque, asperiores perferendis eos nihil, ipsum vitae aperiam 
                        delectus ducimus sit aut, iusto sunt quos ab!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--fin de noticias en linea-->
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
    const noticiasContainer = document.getElementById('noticias-container');
    const carouselIndicatorsRecientes = document.getElementById('carousel-indicators-recientes');
    const carouselInnerRecientes = document.getElementById('carousel-inner-recientes');
    const carouselInnerImagenes = document.getElementById('carousel-inner-imagenes');

    // Realizar una solicitud AJAX para obtener las noticias
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../funcionesNoticias/get_noticia.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const noticias = JSON.parse(xhr.responseText);
                noticias.forEach((noticia, index) => {
                    // Crear tarjeta de noticia
                    const card = document.createElement('div');
                    card.className = 'card';
                    card.innerHTML = `
                        <img src="../../admin/uploads/${noticia.imagen}" width="60px" height="60px" alt="">
                        <div class="card-body">
                            <h5 class="card-title">${noticia.titulo}</h5>
                            <p class="card-text">${noticia.descripcion}</p>
                            <a href="./desNoticia.php?id=${noticia.id_noticias}" class="btn btn-primary">Leer mas</a>
                        </div>
                    `;
                    noticiasContainer.appendChild(card);

                    // Crear item de carrusel para noticias recientes
                    const carouselItemRecientes = document.createElement('div');
                    carouselItemRecientes.className = 'carousel-item' + (index === 0 ? ' active' : '');
                    carouselItemRecientes.innerHTML = `
                        <img src="../../admin/uploads/${noticia.imagen}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>${noticia.titulo}</h5>
                            <p>${noticia.descripcion}</p>
                        </div>
                    `;
                    carouselInnerRecientes.appendChild(carouselItemRecientes);

                    // Crear indicador de carrusel para noticias recientes
                    const indicatorRecientes = document.createElement('button');
                    indicatorRecientes.type = 'button';
                    indicatorRecientes.dataset.bsTarget = '#carouselNoticiasRecientes';
                    indicatorRecientes.dataset.bsSlideTo = index;
                    indicatorRecientes.className = index === 0 ? 'active' : '';
                    indicatorRecientes.ariaCurrent = index === 0 ? 'true' : '';
                    indicatorRecientes.ariaLabel = `Slide ${index + 1}`;
                    carouselIndicatorsRecientes.appendChild(indicatorRecientes);

                    /* Crear item de carrusel para imágenes de noticias
                    const carouselItemImagenes = document.createElement('div');
                    carouselItemImagenes.className = 'carousel-item' + (index === 0 ? ' active' : '');
                    carouselItemImagenes.innerHTML = `
                        <img src="../../admin/uploads/${noticia.imagen}" class="d-block w-100" alt="...">
                    `;
                    carouselInnerImagenes.appendChild(carouselItemImagenes);*/
                });
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response:', xhr.responseText);
                Swal.fire('Error', 'Error al cargar las noticias', 'error');
            }
        } else {
            Swal.fire('Error', 'Error al cargar las noticias', 'error');
        }
    };
    xhr.send();
});
</script>
</body>
</html>