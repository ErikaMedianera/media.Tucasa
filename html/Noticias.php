<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> NOticias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <!--<link rel="stylesheet" href="../css/bootstrap.min.css"-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
/* Limitar la altura del cuerpo de la tabla */
.table-scroll tbody {
    display: block;
    max-height: 300px; /* Ajusta la altura máxima según tus necesidades */
    overflow-y: auto;
}

/* Asegurar que los encabezados de la tabla permanezcan visibles */
.table-scroll thead,
.table-scroll tr {
    display: table;
    width: 100%;
    table-layout: fixed; /* Asegura que las columnas tengan un ancho fijo */
}

/* Asegurar que las celdas del cuerpo coincidan con las del encabezado */
.table-scroll td {
    width: 100%;
    word-wrap: break-word; /* Ajusta el texto si es demasiado largo */
}
</style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block barra-lateral p-3">
                <h3 class="text-white text-center">Dashboard</h3>
                <a href="./index.php">
                    <span class="nav_links"><i class="fa-solid fa-house"></i></span>
                    <span>Inicio</span>
                </a>

                <a href="./usuarios.php">
                    <span class="nav_links"><i class="fa-solid fa-user"></i></span>
                    <span>Usuarios</span>
                </a>

                <a href="./ResenasPropiedad.php">
                    <span class="nav_links"><i class="fa-solid fa-star"></i></span>
                    <span class="nav_links">Reseñas</span>
                </a>

                <a href="./Noticias.php">
                    <span class="nav_links"><i class="fa-solid fa-newspaper"></i></span>
                    <span class="nav_links">Noticias</span>
                </a>

                <a href="./servicio.php">
                    <span class="nav_links"><i class="fa-solid fa-concierge-bell"></i></span>
                    <span class="nav_links">Servicio</span>
                </a>

                <a href="./RegistroPropeidad.php">
                    <span class="nav_links"><i class="fa-solid fa-building"></i></span>
                    <span class="nav_links">Registros</span>
                </a>

                <a href="./nosotros.php">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Nosotros</span>
                </a>
                <a href="./imagenes.php">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Galeria</span>
                </a>
            </nav>

            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 contenido-principal">
                <nav class="navbar navbar-light bg-light mb-4 ">
                    <button class="btn btn-dark d-md-none" onclick="toggleSidebar()">☰</button>
                    <div class="buscar">
                        <input class="form-control me-2" type="search" id="buscar" placeholder="Buscar por título o fecha de publicación" aria-label="Buscar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <div class="perfil">
                        <img src="../imagenes/1.jpeg" alt="Usuario">
                        <span>Usuario</span>
                    </div>
                </nav>



                <div class="mt-4">
                    <div class="modales">
                        <h4>Registros de noticias</h4>
                        <!--COMIENZO DE REGISTRO DE PROPIEDADES-->

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Nueva noticia
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de noticia</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--FORMULARIO DE REGISTRO DE PROPIEDADES-->
                                        <form id="form_noticia" enctype="multipart/form-data">
                                            <input type="hidden" id="id_propiedad" name="id_propiedad">
                                            <div class="mb-3">
                                                <input type="file" class="form-control" id="imagen" name="imagen"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="titulo" name="titulo"
                                                    placeholder="Título" required>
                                            </div>
                                            <div class="mb-3">
                                                <textarea class="form-control" id="descripcion" name="descripcion"
                                                    placeholder="Descripción" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input type="date" class="form-control" id="fecha_publicacion"
                                                    name="fecha_publicacion" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </form>
                                        <!--FIN DE FORMULARIO DE REGISTRO DE PROPIEDADES-->

                                        

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--FIN DE REGISTRO DE PROPIEDADES-->



                        <!-- Modal para actualizar noticias -->
<div class="modal fade" id="actualizar" tabindex="-1" aria-labelledby="actualizarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="actualizarLabel">Actualizar noticia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioActualizar" enctype="multipart/form-data">
                    <input type="hidden" id="idNoticiaActualizar" name="id_noticias">
                    <div class="mb-3">
                        <label for="imagenActualizar" class="form-label">Imagen (opcional)</label>
                        <input type="file" class="form-control" id="imagenActualizar" name="imagen">
                    </div>
                    <div class="mb-3">
                        <label for="tituloActualizar" class="form-label">Título</label>
                        <input type="text" class="form-control" id="tituloActualizar" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionActualizar" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionActualizar" name="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fechaActualizar" class="form-label">Fecha de publicación</label>
                        <input type="date" class="form-control" id="fechaActualizar" name="fecha_publicacion" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

                        
                    </div>
                    <table id="propertyTable" class="table table-hover table-bordered tabla-color table-scroll">
                        <thead class="table">
                            <tr>

                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th>Fecha de publicacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_body">
                        
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="../js/noticias_new.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
</body>

</html>

