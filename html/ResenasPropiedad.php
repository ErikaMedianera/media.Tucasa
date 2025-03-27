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
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    
                    <div class="perfil">
                        <img src="../imagenes/1.jpeg" alt="Usuario">
                        <span>Usuario</span>
                    </div>
                </nav>
               
                <!-- Tabla de Reseñas -->
                <div class="mt-4">
                    <h4>Reseñas</h4>
                    <table class="table table-hover table-bordered tabla-color table-scroll">
                        <thead class="table">
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Comentario</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_body">
                            <?php
                            include '../controladores/conexion.php';

                            // Actualizar la consulta para usar id_resena
                            $query = "SELECT id_resena, imagen, nombre, comentario FROM resenas";
                            $result = $conexion->query($query);

                            if (!$result) {
                                echo "<tr><td colspan='4' class='text-center'>Error en la consulta: " . $conexion->error . "</td></tr>";
                            } elseif ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><img src='../imagenes/" . htmlspecialchars($row['imagen']) . "' alt='Imagen' style='width: 50px; height: 50px; object-fit: cover;'></td>";
                                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['comentario']) . "</td>";
                                    echo "<td><button class='btn btn-info btn-sm' onclick='verResena(" . $row['id_resena'] . ")'><i class='fa-solid fa-eye'></i> </button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No hay reseñas disponibles</td></tr>";
                            }

                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Modal para ver reseña -->
    <div class="modal fade" id="modalVerResena" tabindex="-1" aria-labelledby="modalVerResenaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalVerResenaLabel">Detalles de la Reseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="imagenResena" src="" alt="Imagen de la reseña" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 15px;">
                    </div>
                    <p><strong>Nombre:</strong> <span id="nombreResena"></span></p>
                    <p><strong>Comentario:</strong> <span id="comentarioResena"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
    </script>
    <script>
        function verResena(id) {
            // Realizar una solicitud AJAX para obtener los datos de la reseña
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `./obtener_resena.php?id=${id}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const resena = JSON.parse(xhr.responseText);
                    if (resena.success) {
                        // Cargar los datos en el modal
                        document.getElementById('imagenResena').src = `../imagenes/${resena.data.imagen}`;
                        document.getElementById('nombreResena').textContent = resena.data.nombre;
                        document.getElementById('comentarioResena').textContent = resena.data.comentario;

                        // Mostrar el modal
                        const modal = new bootstrap.Modal(document.getElementById('modalVerResena'));
                        modal.show();
                    } else {
                        alert('No se pudo obtener la reseña.');
                    }
                }
            };
            xhr.send();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
