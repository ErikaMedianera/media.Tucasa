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
                   

                    <div class="perfil">
                        <img src="../imagenes/1.jpeg" alt="Usuario">
                        <span>Usuario</span>
                    </div>
                </nav>



                <div class="mt-4">
                    <div class="modales">
                        <h4>Emails</h4>


                        

                        
                    </div>
                    <table id="propertyTable" class="table table-hover table-bordered tabla-color table-scroll">
                        <thead class="table">
                            <tr>

                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_body">
                            <!-- Los datos se cargarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal para ver los datos -->
    <div class="modal fade" id="verModal" tabindex="-1" aria-labelledby="verModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verModalLabel">Detalles del Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                    <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                    <p><strong>Descripción:</strong> <span id="modalDescripcion"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const tablaBody = document.getElementById("tabla_body");

        // Función para cargar los datos de la tabla email
        function cargarEmails() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../funcionesEmail/obtener_emails.php", true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        const emails = JSON.parse(xhr.responseText);

                        // Verificar si hay un error en la respuesta
                        if (emails.error) {
                            console.error("Error del servidor:", emails.error);
                            Swal.fire("Error", "No se pudieron cargar los datos: " + emails.error, "error");
                            return;
                        }

                        // Limpiar el contenido actual de la tabla
                        tablaBody.innerHTML = "";

                        // Agregar los datos a la tabla
                        emails.forEach(email => {
                            const fila = document.createElement("tr");

                            fila.innerHTML = `
                                <td>${email.nombre}</td>
                                <td>${email.email}</td>
                                <td>${email.texto}</td>
                                <td>
                                    <button class="btn btn-info btn-sm ver-btn" data-nombre="${email.nombre}" data-email="${email.email}" data-descripcion="${email.descripcion}">
                                     <i class="fas fa-eye"></i>
                                    </button>
                                    
                                </td>
                            `;

                            tablaBody.appendChild(fila);
                        });

                        // Agregar eventos a los botones "Ver"
                        const verButtons = document.querySelectorAll(".ver-btn");
                        verButtons.forEach(button => {
                            button.addEventListener("click", function () {
                                const nombre = this.getAttribute("data-nombre");
                                const email = this.getAttribute("data-email");
                                const descripcion = this.getAttribute("data-descripcion");

                                // Mostrar los datos en el modal
                                document.getElementById("modalNombre").textContent = nombre;
                                document.getElementById("modalEmail").textContent = email;
                                document.getElementById("modalDescripcion").textContent = descripcion;

                                // Abrir el modal
                                const modal = new bootstrap.Modal(document.getElementById("verModal"));
                                modal.show();
                            });
                        });
                    } catch (error) {
                        console.error("Error al analizar el JSON:", error);
                        Swal.fire("Error", "La respuesta del servidor no es válida.", "error");
                    }
                } else {
                    console.error("Error al cargar los datos de la tabla email.");
                    Swal.fire("Error", "No se pudieron cargar los datos.", "error");
                }
            };

            xhr.onerror = function () {
                console.error("Error de red al intentar cargar los datos.");
                Swal.fire("Error", "Error de red al intentar cargar los datos.", "error");
            };

            xhr.send();
        }

        // Llamar a la función para cargar los datos al cargar la página
        cargarEmails();
    });
</script>

</body>

</html>