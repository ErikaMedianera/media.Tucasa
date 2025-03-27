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



                <div class="mt-4">
                    <div class="modales">
                        <h4>Registros de noticias</h4>
                       <!-- Botón para abrir el Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Registrar Imagen
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Registro de Imagenes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formImagen" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id_noticias" class="form-label">Selecciona Noticia:</label>
                            <select id="id_noticias" name="id_noticias" class="form-select">
                                <!-- Aquí deben cargarse las noticias desde la base de datos -->
                                <option value="1">Noticia 1</option>
                                <option value="2">Noticia 2</option>
                                <!-- Más opciones... -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_propiedad" class="form-label">Selecciona Propiedad:</label>
                            <select id="id_propiedad" name="id_propiedad" class="form-select">
                                <!-- Aquí deben cargarse las propiedades desde la base de datos -->
                                <option value="1">Propiedad 1</option>
                                <option value="2">Propiedad 2</option>
                                <!-- Más opciones... -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Seleccionar Imagen:</label>
                            <input type="file" id="imagen" name="imagen" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Subir Imagen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

                        <!-- Modal para actualizar imagenes -->
<div class="modal fade" id="actualizar" tabindex="-1" aria-labelledby="actualizarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="actualizarLabel">Actualizar noticia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
            </div>
        </div>
    </div>
</div>

<!-- Modal para insertar imágenes -->
<div class="modal fade" id="modalInsertarImagen" tabindex="-1" aria-labelledby="modalInsertarImagenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalInsertarImagenLabel">Registrar Imagen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formImagen" enctype="multipart/form-data">
        <label for="id_noticias">Selecciona Noticia:</label>
        <select id="id_noticias" name="id_noticias">
            <!-- Aquí deben cargarse las noticias desde la base de datos -->
            <option value="1">Noticia 1</option>
            <option value="2">Noticia 2</option>
            <!-- Más opciones... -->
        </select>
        <br><br>
        
        <label for="id_propiedad">Selecciona Propiedad:</label>
        <select id="id_propiedad" name="id_propiedad">
            <!-- Aquí deben cargarse las propiedades desde la base de datos -->
            <option value="1">Propiedad 1</option>
            <option value="2">Propiedad 2</option>
            <!-- Más opciones... -->
        </select>
        <br><br>
        
        <label for="imagen">Seleccionar Imagen:</label>
        <input type="file" id="imagen" name="imagen" required>
        <br><br>
        
        <button type="submit">Subir Imagen</button>
    </form>
            </div>
        </div>
    </div>
</div>

                        
                    </div>
                    <table id="propertyTable" class="table table-hover table-bordered tabla-color">
                        <thead class="table">
                            <tr>

                                <th>Id Noticias</th>
                                <th>Id Propiedad</th>
                                <th>Ruta de la imagen</th>
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

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const formImagen = document.getElementById("formImagen");

        formImagen.addEventListener("submit", function(event) {
            event.preventDefault(); // Evita que se recargue la página

            const formData = new FormData(formImagen);
            const xhr = new XMLHttpRequest();

            xhr.open("POST", "../funcionesImagenes/insertar_imagen.php", true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = xhr.responseText;

                    if (response === "success") {
                        Swal.fire(
                            'Éxito!',
                            'La imagen se subió correctamente.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            'Hubo un problema al subir la imagen.',
                            'error'
                        );
                    }
                } else {
                    Swal.fire(
                        'Error!',
                        'Hubo un problema con la solicitud.',
                        'error'
                    );
                }
            };

            xhr.onerror = function() {
                Swal.fire(
                    'Error!',
                    'No se pudo completar la solicitud.',
                    'error'
                );
            };

            xhr.send(formData);
        });
    });
</script>

    
</body>

</html>

