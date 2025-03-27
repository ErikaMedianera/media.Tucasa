<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <!--<link rel="stylesheet" href="../css/bootstrap.min.css"-->
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
.table-scroll td,
.table-scroll th {
    word-wrap: break-word; /* Ajusta el texto si es demasiado largo */
    white-space: nowrap; /* Evita que el texto se divida en varias líneas */
    overflow: hidden; /* Oculta el contenido que excede el ancho de la celda */
    text-overflow: ellipsis; /* Agrega puntos suspensivos (...) al contenido largo */
}

/* Opcional: Estilo para el contenido largo al pasar el mouse */
.table-scroll td:hover {
    overflow: visible; /* Muestra el contenido completo al pasar el mouse */
    white-space: normal; /* Permite que el texto se divida en varias líneas */
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
                   
                    <div class="perfil">
                        <img src="../imagenes/1.jpeg" alt="Usuario">
                        <span>Usuario</span>
                    </div>
                </nav>
               
                
                <!-- Tabla de Facturas Recientes -->
                <div class="mt-4">
                    <h4>Usuarios</h4>
                    <table class="table table-hover table-bordered tabla-color scroll">
                        <thead class="table" >
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Contrasena</th>
                                <th>Confirmar Contrasena</th>
                               
                                
                            </tr>
                        </thead>
                        <tbody id="tabla_usuario">
                            
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
    <script src="../js/usuarios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
