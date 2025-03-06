<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <!--<link rel="stylesheet" href="../css/bootstrap.min.css"-->
    <style>
       
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block barra-lateral p-3">
                <h3 class="text-white text-center">Dashboard</h3>
                <a href="../html/Usuarios.html">
                    <span  class="nav_links"><i class="fa-solid fa-user"></i></span>
                    <span>Inicio</span>
                    
                </a>
                <a href="../html/PunlicacionPropiedad.html">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span>Propiedades</span>
                    
                </a>
                
                <a href="../html/ReservaPropiedad.html">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span>Reservas</span>
                    
                </a>
                <a href="../html/ResenasPropiedad.html">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Resenas</span>
                    
                    
                </a>
                <a href="../html/Noticias.html">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Noticias</span>
                    
                    
                </a>
                <a href="../html/ServicioCliente.html">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Servicio</span>
                    
                    
                </a>
                <a href="../html/promociones.html">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Promocion</span>
                    
                    
                </a>
                <a href="../html/RegistroPropeidad.html">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Registros</span>
                    
                    
                </a>
            </nav>
            
            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 contenido-principal">
                <nav class="navbar navbar-light bg-light mb-4 ">
                    <button class="btn btn-dark d-md-none" onclick="toggleSidebar()">☰</button>
                    <div class="buscar">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    
                    <div class="perfil">
                        <img src="../imagenes/1.jpeg" alt="Usuario">
                        <span>Usuario</span>
                    </div>
                </nav>
                <!--<div class="row tarjetas g-3">
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Clientes</h5>
                            <p class="text-success">+4.5% esta semana</p>
                            <h3>1,456</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Ingresos</h5>
                            <p class="text-danger">-0.10% esta semana</p>
                            <h3>$3,345</h3>
                            
                        </div>
                       
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Ganancias</h5>
                            <p class="text-danger">-0.2% esta semana</p>
                            <h3>60%</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Facturas</h5>
                            <p class="text-primary">+1.15% esta semana</p>
                            <h3>1,135</h3>
                        </div>
                    </div>
                </div>-->
                
                <!-- Tabla de Facturas Recientes -->
                <div class="mt-4">
                    <div class="modales">

                        <h4>Noticias</h4>
                        <!--COMIENZO DE REGISTRO DE NOTICIAS-->
    
                        <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nueva Noticia
      </button>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORMULARIO DE REGISTRO DE NOTICIAS-->
                <form action="" method="POST" enctype="multipart/form-data" id="formulario">
                <div class="mb-3">
                    <label for="imagen">Imagen:</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" placeholder="imagen" aria-describedby="emailHelp">
                        <div id="errortitulo" class="form-text"></div>
                      </div>    
                <div class="mb-3">
                    <label for="titulo">Titulo:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo de noticia" aria-describedby="emailHelp">
                        <div id="errortitulo" class="form-text"></div>
                      </div>
                      
                    <div class="mb-3">
                        <label for="descripcion"> Descripcion:</label>
                     <textarea name="descripcion" id="descripcion"></textarea>
                      <div id="errordescripcion" class="form-text"></div>
                    </div>
                   
                    <div class="mb-3">
                        <label for="fecha_publicacion"></label>
                      <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" placeholder="Fecha de registro" aria-describedby="emailHelp">
                      <div id="errorfechaRegistro" class="form-text"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </form>
                <!--FORMULARIO DE REGISTRO DE NOTICIAS-->
              
            </div>
            
          </div>
        </div>
      </div>
     <!--FIN DE REGISTRO DE NOTICIAS-->
                    </div>
                 
                    <table class="table table-hover table-bordered tabla-color">
                        <thead class="table" >
                            <tr>
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Fecha</th>
                                <th colspan="3">Acciones</th>
                                
                            </tr>
                        </thead>
                        <tbody id="tabla_body">
                            
                           
                            
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
    </script>
    <script src="../js/noticias.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>
