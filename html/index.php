<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Responsivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Biblioteca Chart.js -->
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
                <a href="./email.php">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Emails</span>
                </a>
                <a href="./imagenes.php">
                    <span class="nav_links"><i class="fa-solid fa-users"></i></span>
                    <span class="nav_links">Galeria</span>
                </a>
            </nav>

            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 contenido-principal">
                <nav class="navbar navbar-light bg-light mb-4">
                    <button class="btn btn-dark d-md-none" onclick="toggleSidebar()">☰</button>
                    <div class="buscar">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="perfil">
                        <img src="../imagenes/1.jpeg" alt="Usuario" style="width: 40px; height: 40px; border-radius: 50%;">
                        <span>Usuario</span>
                    </div>
                </nav>

                <div class="row tarjetas g-3">
                    <!-- Tarjeta de Usuarios -->
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Usuarios</h5>
                            <p class="text-success">Total registrados</p>
                            <h3 id="total-usuarios">0</h3>
                        </div>
                    </div>

                    <!-- Tarjeta de Propiedades Disponibles -->
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Propiedades Disponibles</h5>
                            <p class="text-primary">Total disponibles</p>
                            <h3 id="propiedades-disponibles">0</h3>
                        </div>
                    </div>

                    <!-- Tarjeta de Propiedades Ocupadas -->
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Propiedades Ocupadas</h5>
                            <p class="text-danger">Total ocupadas</p>
                            <h3 id="propiedades-ocupadas">0</h3>
                        </div>
                    </div>

                    <!-- Tarjeta de Total de Propiedades -->
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Total de Propiedades</h5>
                            <p class="text-info">Todas las propiedades</p>
                            <h3 id="total-propiedades">0</h3>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Facturas Recientes -->
                <div class="mt-4">
                    <table class="table table-hover table-bordered tabla-color  table-scroll">
                        <thead class="table">
                            <tr>
                                <th>Tipo de Propiedad</th>
                                <th>Contacto</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Fecha Publicación</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_body">
                            <!-- Los datos se cargarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>

                <!-- Gráficas -->
                <div class="mt-5">
                    <h4 class="text-center">Gráficas de Propiedades por Estado</h4>
                    <div class="row">
                        <!-- Gráfica de Barras -->
                        <div class="col-md-6">
                            <canvas id="graficaBarras"></canvas>
                        </div>
                        <!-- Gráfica Circular -->
                        <div class="col-md-6">
                            <canvas id="graficaCircular"></canvas>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="../js/cargarDatos_dashboard.js"></script>
    <script src="../js/inicio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>