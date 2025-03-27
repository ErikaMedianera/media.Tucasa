<?php
include '../controladores/conexion.php';

// Consulta SQL para obtener los datos de la tabla "propiedades"
$sql_propiedades = "SELECT id_propiedad, titulo, descripcion, imagen FROM propiedades";
$resultado_propiedades = mysqli_query($conexion, $sql_propiedades);

// Verificar si la consulta fue exitosa
if (!$resultado_propiedades) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Consulta SQL para obtener los datos de la tabla "servicios"
$sql_servicios = "SELECT idServicio, nombre, descripcion FROM servicios";
$resultado_servicios = mysqli_query($conexion, $sql_servicios);

// Verificar si la consulta fue exitosa
if (!$resultado_servicios) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/pruebacasas.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  <!--COMIENZO DE REGISTRO DE PROPIEDADES-->

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Nueva Propiedad
                      </button>
                      
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Propiedades</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!--FORMULARIO DE REGISTRO DE PROPIEDADES-->
                                <form id="form_propiedad" enctype="multipart/form-data">
                                    <input type="hidden" id="id_propiedad" name="id_propiedad">
                                    <div class="mb-3">
                                        <input type="file" class="form-control" id="imagen" name="imagen" required> 
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Contacto" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo" required>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control" id="estado" name="estado" required>
                                            <option value="">Seleccione el estado</option>
                                            <option value="Disponible">Disponible</option>
                                            <option value="Ocupado">Ocupado</option>
                                            <option value="Reservado">Reservado</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                                <!--FIN DE FORMULARIO DE REGISTRO DE PROPIEDADES-->
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                                         <!--FIN DE REGISTRO DE PROPIEDADES-->

        <li class="nav-item dropdown">
        <div class="search-container">
                <button class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input type="text" class="search-input" placeholder="Buscar...">
               </div>
          </ul>
        </li>


        
      </ul>
    </div>
  </div>
</nav>
</nav>
        
    </header>
    <!--COMIENZO DE LA PARTE DEL HEADER-->
    <div class="container linea-servicios">
      <hr class="hr-rigth">
      <h1>Servicios</h1>
      <hr class="hr-left">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <!--COMIENZO DE LA PARTE DE LOS SERVICIOS DE LINEAS-->
    <div class="container-fluid contenedor-servicios">
      <ul>
        <h4>En las casas</h4>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
      </ul>

      <ul>
      <h4>En las casas</h4>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
      </ul>

      <ul>
      <h4>En las casas</h4>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
      </ul>

      <ul>
      <h4>En las casas</h4>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
        <li>
          <a href="">
          <i class="fa-solid fa-caret-right"></i>
          <span>Busqueda de casas</span>
          </a>
        </li>
      </ul>
    </div>
    <!--FIN DE LA PARTE DE LOS SERVICIOS DE LINEAS-->

    <div class="container-fluid servicio-imagen">
      
    <div class="container linea-servicios">
      <hr class="hr-rigth">
      <h1>Propiedades</h1>
      <hr class="hr-left">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
   

    <div class="container row tarjetas">
    <?php
    // Generar tarjetas dinámicamente
    if (mysqli_num_rows($resultado_propiedades) > 0) {
        while ($propiedad = mysqli_fetch_assoc($resultado_propiedades)) {
            // Validar y normalizar la ruta de la imagen
            $imagen_ruta = !empty($propiedad['imagen']) ? trim($propiedad['imagen']) : 'default.jpg';
            $ruta_completa = "../../admin/uploads/" . $imagen_ruta;

            // Verificar si la imagen existe en el servidor
            $ruta_absoluta = $_SERVER['DOCUMENT_ROOT'] . "/TuCasa.com/admin/uploads/" . $imagen_ruta;
            if (!file_exists($ruta_absoluta)) {
                $ruta_completa = "../../admin/uploads/default.jpg"; // Usar imagen predeterminada si no existe
            }

            // Generar la tarjeta
            echo '
            <div class="card col-md-3" style="width: 20rem;">
                <img src="' . htmlspecialchars($ruta_completa) . '" class="card-img-top" alt="' . htmlspecialchars($propiedad['titulo']) . '">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($propiedad['titulo']) . '</h5>
                    <p class="card-text">' . htmlspecialchars($propiedad['descripcion']) . '</p>
                    <a href="propiedad.php?id=' . htmlspecialchars($propiedad['id_propiedad']) . '" class="btn btn-primary">Ver más</a>
                </div>
            </div>';
        }
    } else {
        echo '<p>No hay propiedades disponibles.</p>';
    }
    ?>
    </div>

    <!--FIN DE LA PARTE DE LOS SERVICIOS DE TARJETAS-->
    </div>

 <!--Comienzo de otros servicios-->
    <div class="container-fluid otros-servicios">
    <div class="container linea-servicios">
      <hr class="hr-rigth">
      <h1>Servicios</h1>
      <hr class="hr-left">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <div class="contenido-otros-service">
      <?php
      // Generar servicios dinámicamente
      if (mysqli_num_rows($resultado_servicios) > 0) {
          while ($servicio = mysqli_fetch_assoc($resultado_servicios)) {
              echo '
              <div class="service-numero">
                  <span>' . htmlspecialchars($servicio['idServicio']) . '</span>
                  <div class="lorem">
                      <h3>' . htmlspecialchars($servicio['nombre']) . '</h3>
                      <p>' . htmlspecialchars($servicio['descripcion']) . '</p>
                  </div>
              </div>';
          }
      } else {
          echo '<p>No hay servicios disponibles.</p>';
      }
      ?>
    </div>
    </div>
    <!--Comienzo de otros servicios-->


    <!--Comienzo suscripciones-->
    <div class="container-fluid suscripcion">
      <h2>Suscribete a nuestra pagina web</h2>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat neque ad dolor amet porro assumenda facilis ipsa, ratione impedit nulla.</p>
      <div class="linea">
        <hr>
        <button class="btn btn-outline-warning">Suscribete</button>
      </div>
    </div>
    <div class="container">
    <div class="container linea-servicios">
      <hr class="hr-rigth">
      <h1>Servicios</h1>
      <hr class="hr-left">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <!--COMIENZO DE LAS REDES SOCIALES-->
    <div class=" sociales">
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
    <!--COMIENZO DE LAS REDES SOCIALES-->
    </div>
    <!--Fin de suscripciones-->

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
   
    <script src="../js/input.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<script>
        document.getElementById('form_propiedad').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'guardar_propiedad.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Propiedad registrada',
                            text: 'La propiedad se ha registrado exitosamente.',
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error || 'Hubo un problema al registrar la propiedad.',
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema con la solicitud.',
                    });
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>