<?php
include './controladores/conexion.php';

// Consulta SQL para obtener los cuatro servicios más recientes
$sql_servicios = "SELECT * FROM servicios ORDER BY idServicio DESC LIMIT 4";
$resultado_servicios = mysqli_query($conexion, $sql_servicios);
if (!$resultado_servicios) {
    die('Error en la consulta de servicios: ' . mysqli_error($conexion));
}

// Consultas SQL para obtener los datos del contador
$sql_total_casas = "SELECT COUNT(*) AS total FROM propiedades";
$sql_usuarios = "SELECT COUNT(*) AS total FROM usuarios";
$sql_casas_ocupadas = "SELECT COUNT(*) AS total FROM propiedades WHERE estado = 'Ocupado'";
$sql_casas_libres = "SELECT COUNT(*) AS total FROM propiedades WHERE estado = 'Disponible'";

$resultado_total_casas = mysqli_query($conexion, $sql_total_casas);
$resultado_usuarios = mysqli_query($conexion, $sql_usuarios);
$resultado_casas_ocupadas = mysqli_query($conexion, $sql_casas_ocupadas);
$resultado_casas_libres = mysqli_query($conexion, $sql_casas_libres);

if (!$resultado_total_casas || !$resultado_usuarios || !$resultado_casas_ocupadas || !$resultado_casas_libres) {
    die('Error en las consultas del contador: ' . mysqli_error($conexion));
}

$total_casas = mysqli_fetch_assoc($resultado_total_casas)['total'];
$total_usuarios = mysqli_fetch_assoc($resultado_usuarios)['total'];
$total_casas_ocupadas = mysqli_fetch_assoc($resultado_casas_ocupadas)['total'];
$total_casas_libres = mysqli_fetch_assoc($resultado_casas_libres)['total'];

// Consulta SQL para obtener los comentarios de la tabla resenas
$sql_resenas = "SELECT * FROM resenas ORDER BY fecha_resena DESC";
$resultado_resenas = mysqli_query($conexion, $sql_resenas);
if (!$resultado_resenas) {
    die('Error en la consulta de reseñas: ' . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuCasa</title>
    <link rel="stylesheet" href="./css/index2.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/sweetalert2.css">
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
          <a class="nav-link active" aria-current="page" href="./index.html">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./php/pruebacasas.php">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./php/nosotros.php">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./php/contactos.php">Contactos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./php/noticia.php">Noticias</a>
          </li>
          <!--Modal con formulario de registro-->
       <!-- Button trigger modal -->
<button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#authModal">
    Registrarse / Iniciar Sesión
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="authModalLabel">Autenticación</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Pestañas de Registro e Inicio de Sesión -->
          <ul class="nav nav-tabs" id="authTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="true">Registrarse</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="false">Iniciar Sesión</button>
            </li>
          </ul>
          <div class="tab-content" id="authTabContent">
            <!-- Formulario de Registro -->
            <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
              <form id="formularioRegistro">
                <div class="mb-3">
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Inserte su nombre" required>
                  <div id="errornom" class="form-text error"></div>
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                  <div id="errorema" class="form-text error"></div>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
                  <div id="errorpas" class="form-text error"></div>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" id="confirmcontraseña" name="confirmcontraseña" placeholder="Confirmar contraseña" required>
                  <div id="errorConfirmpas" class="form-text error"></div>
                </div>
                <button type="button" class="btn btn-primary w-100" onclick="registrarUsuario()">Enviar</button>
              </form>
            </div>
            <!-- Formulario de Inicio de Sesión -->
            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
              <form id="formularioLogin">
                <div class="mb-3">
                  <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Correo electrónico" aria-describedby="emailHelp" required>
                  <div id="errorLoginEmail" class="form-text error"></div>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" id="loginContraseña" name="contraseña" placeholder="Contraseña" required>
                  <div id="errorLoginContraseña" class="form-text error"></div>
                </div>
                <button type="button" class="btn btn-primary w-100" onclick="iniciarSesion()">Iniciar Sesión</button>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
          <!--fin Modal con formulario de registro-->
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

<!--SECCION DE SERVICIOS-->
    <div class="container-fluid">
        <section class="features">
            <?php
            while ($servicio = mysqli_fetch_assoc($resultado_servicios)) {
                // Aquí se muestra cada servicio con su nombre, descripción e icono
            ?>
            <div class="feature-box" style="background: #2196F3;">
                <div class="feature-icon">
                    <i class="fa-solid fa-cogs fa-3x text-white"></i>
                </div>
                <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
                <p><?php echo htmlspecialchars($servicio['descripcion']); ?></p>
            </div>
            <?php } ?>
        </section>

        <!--SECCION DE SERVICIOS-->
    
        <section class="professional-section">
            <div class="professional-container">
                <div class="logo-section left-logos">
                    <div class="pro-logo">
                        <div class="logo-circle">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4>Professional</h4>
                        <p>Expert Care Services</p>
                    </div>
                    <div class="pro-logo">
                        <div class="logo-circle">
                            <i class="fas fa-award"></i>
                        </div>
                        <h4>Professional</h4>
                        <p>Quality Healthcare</p>
                    </div>
                </div>
    
                <div class="doctor-image">
                    <img src="./imagenes/15.jpg" alt="Professional Doctor">
                </div>
    
                <div class="logo-section right-logos">
                    <div class="pro-logo">
                        <div class="logo-circle">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h4>Professional</h4>
                        <p>Trusted Experience</p>
                    </div>
                    <div class="pro-logo">
                        <div class="logo-circle">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>Professional</h4>
                        <p>Excellence in Service</p>
                    </div>
                </div>
            </div>
        </section>
    <!--SECCION DEL CONTADOR-->
        <section class="masked-doctor-section">
            <div class="overlay"></div>
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-circle">
                        <i class="fas fa-home"></i> <!-- Icono de casa para "Todas las casas" -->
                    </div>
                    <div class="stat-number"><?php echo $total_casas; ?></div>
                    <div class="stat-line"></div>
                    <div class="stat-text">Todas las casas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <i class="fas fa-users"></i> <!-- Icono de usuarios para "Usuarios" -->
                    </div>
                    <div class="stat-number"><?php echo $total_usuarios; ?></div>
                    <div class="stat-line"></div>
                    <div class="stat-text">Usuarios</div>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <i class="fas fa-door-closed"></i> <!-- Icono de puerta cerrada para "Casas ocupadas" -->
                    </div>
                    <div class="stat-number"><?php echo $total_casas_ocupadas; ?></div>
                    <div class="stat-line"></div>
                    <div class="stat-text">Casas ocupadas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <i class="fas fa-door-open"></i> <!-- Icono de puerta abierta para "Casas libres" -->
                    </div>
                    <div class="stat-number"><?php echo $total_casas_libres; ?></div>
                    <div class="stat-line"></div>
                    <div class="stat-text">Casas libres</div>
                </div>
            </div>
        </section>
          <!--FIN SECCION DEL CONTADOR-->
    
        <section class="how-we-work">
            <div class="section-header">
                <h2>Cómo trabajamos</h2>
                <p>
                Ofrecemos soluciones de alquiler de viviendas adaptadas a las necesidades
                 de nuestros clientes, brindando propiedades de calidad y un servicio personalizado
                  para garantizar su satisfacción.
                </p>
            </div>
            <div class="work-images">
                <div class="work-image">
                    <img src="./imagenes/2.jpg" alt="Medical Team Discussion">
                </div>
                <div class="work-image">
                   <!-- FORMULARIO DE COMENTARIOS -->
<form id="comentarioForm" enctype="multipart/form-data">
    <div class="mb-3">
        <input type="file" class="form-control" id="imagen" name="imagen" placeholder="La imagen es opcional" aria-describedby="emailHelp">
        <div id="errimg" class="form-text text-danger"></div>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Inserte su nombre" aria-describedby="emailHelp" required>
        <div id="errornom" class="form-text text-danger"></div>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="TuCasa@gmail.com" aria-describedby="emailHelp" required>
        <div id="errorema" class="form-text text-danger"></div>
    </div>
    <div class="mb-3">
        <textarea class="form-control" id="comentario" name="comentario" placeholder="Comentario" required></textarea>
        <div id="errorcomentario" class="form-text text-danger"></div>
    </div>
    <button type="button" class="btn btn-primary w-100" onclick="submitComentario()">Enviar</button>
</form>
<!-- FIN DEL FORMULARIO DE COMENTARIOS -->
                </div>
    
               
    
            </div>
        </section>
    
        <section class="gallery" id="galeria">
            <div class="contenedor">
                <h2 class="subtitulo">Galeria</h2>
                <div class="contenedor-galeria">
                    <img src="./imagenes/pexels-photo-2251247.jpeg" alt="" class="img-galeria">
                    <img src="./imagenes/pexels-photo-2631746.jpeg" alt="" class="img-galeria">
                    <img src="./imagenes/pexels-photo-1396132.jpeg" alt="" class="img-galeria">
                    <img src="./imagenes/pexels-photo-271624.webp" alt="" class="img-galeria">
                    <img src="./imagenes/pexels-photo-210617.jpeg" alt="" class="img-galeria">
                    <img src="./imagenes/pexels-photo-2251247.jpeg" alt="" class="img-galeria">
                </div>
            </div>
        </section>
    
        <!--COMIENZO DE COMENTARIOS-->
    
        <div class="encabezado-revisiones">
            <div class="review-healding">
                <h1>Comentarios</h1>

                
            </div>
    
           
            <div class="main-inner-review">
    <div class="review-inner-content">
        <?php while ($resena = mysqli_fetch_assoc($resultado_resenas)) { ?>
            <div class="card comentario-tarjeta mb-3">
                <div class="card-body text-center">
                    <!-- Imagen del comentario -->
                    <?php if (!empty($resena['imagen'])) { ?>
                        <img src="./imagenes/<?php echo htmlspecialchars($resena['imagen']); ?>" class="img-fluid rounded mb-3 comentario-imagen" alt="Imagen del comentario">
                    <?php } else { ?>
                        <img src="./imagenes/default.jpg" class="img-fluid rounded mb-3 comentario-imagen" alt="Imagen por defecto">
                    <?php } ?>

                    <!-- Nombre del usuario -->
                    <h5 class="card-title"><?php echo htmlspecialchars($resena['nombre']); ?></h5>

                    <!-- Comentario -->
                    <p class="card-text"><?php echo htmlspecialchars($resena['comentario']); ?></p>

                    <!-- Fecha de publicación -->
                    <p class="card-text"><small class="text-muted">Publicado el <?php echo htmlspecialchars($resena['fecha_resena']); ?></small></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
    
        
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

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
    </script>
   
    <script>
        function submitComentario() {
            const formData = new FormData(document.getElementById('comentarioForm'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', './php/insertar_resena.php', true);
            xhr.onload = function () {
                console.log(xhr.responseText); // Verifica qué está devolviendo el servidor
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                        });
                        document.getElementById('comentarioForm').reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                } catch (e) {
                    console.error('Error al procesar la respuesta del servidor:', e);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde.',
                    });
                }
            };
            xhr.send(formData);
        }
    </script>
   
    <script>
        function iniciarSesion() {
            const formData = new FormData(document.getElementById('formularioLogin'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', './php/iniciar_sesion.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                        }).then(() => {
                            // Redirigir al usuario a la página principal o dashboard
                            window.location.href = './php/pruebacasas.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            };
            xhr.send(formData);
        }
    </script>
   
    <script>
    function registrarUsuario() {
        const formData = new FormData(document.getElementById('formularioRegistro'));

        const xhr = new XMLHttpRequest();
        xhr.open('POST', './php/insertar_usuarios.php', true);
        xhr.onload = function () {
            console.log(xhr.responseText); // Verifica qué está devolviendo el servidor
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.message,
                    });
                    document.getElementById('formularioRegistro').reset(); // Limpiar el formulario
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            } catch (e) {
                console.error('Error al procesar la respuesta del servidor:', e);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde.',
                });
            }
        };
        xhr.send(formData);
    }
</script>

     <script src="./js/validacionForm.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/sweetalert2.js"></script>