<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>publicacion de propiedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
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
                <nav class="navbar navbar-light bg-light mb-4">
                    <button class="btn btn-dark d-md-none" onclick="toggleSidebar()">☰</button>
                    <div class="buscar">
                        <input class="form-control me-2" type="search" id="buscar" placeholder="Buscar..." aria-label="Buscar">
                    </div>
                    <div class="perfil">
                        <img src="../imagenes/1.jpeg" alt="Usuario">
                        <span>Usuario</span>
                    </div>
                </nav>

                <div class="mt-4">
                    <div class="modales">
                        <h4>Registros de propiedades</h4>
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

                        <!-- Modal para editar propiedad -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editModalLabel">Editar Propiedad</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario de actualización -->
                                        <form id="form_update_propiedad" enctype="multipart/form-data">
                                            <input type="hidden" id="id_propiedad_edit" name="id_propiedad">
                                            <div class="mb-3">
                                                <input type="file" class="form-control" id="imagen_edit" name="imagen">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="titulo_edit" name="titulo" placeholder="Título" required>
                                            </div>
                                            <div class="mb-3">
                                                <textarea class="form-control" id="descripcion_edit" name="descripcion" placeholder="Descripción" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" class="form-control" id="precio_edit" name="precio" placeholder="Precio" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="ubicacion_edit" name="ubicacion" placeholder="Ubicación" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="contacto_edit" name="contacto" placeholder="Contacto" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="tipo_edit" name="tipo" placeholder="Tipo" required>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control" id="estado_edit" name="estado" required>
                                                    <option value="">Seleccione el estado</option>
                                                    <option value="Disponible">Disponible</option>
                                                    <option value="Ocupado">Ocupado</option>
                                                    <option value="Reservado">Reservado</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </form>
                                        <!-- Fin de formulario de actualización -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN DE MODAL PARA EDITAR PROPIEDAD-->
                    </div>
                    <table id="propertyTable" class="table table-hover table-bordered tabla-color table-scroll">
                        <thead class="table">
                            <tr>
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Ubicación</th>
                                <th>Contacto</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../controladores/conexion.php';

                            // Ejecutar la consulta para obtener las propiedades
                            $query = "SELECT id_propiedad, imagen, titulo, descripcion, precio, ubicacion, contacto, tipo, estado, fecha_publicacion FROM propiedades";
                            $result = $conexion->query($query);

                            if ($result->num_rows > 0) {
                                // Salida de cada fila
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><img src='../uploads/" . htmlspecialchars($row['imagen']) . "' alt='Imagen' width='100'></td>";
                                    echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['contacto']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
                                    echo "<td class='text-center'>
                                            <button class='btn btn-info btn-sm me-1' onclick='verPropiedad(" . intval($row['id_propiedad']) . ")' title='Ver detalles'>
                                                <i class='fas fa-eye'></i>
                                            </button>
                                            <button class='btn btn-warning btn-sm me-1' onclick='editarPropiedad(" . intval($row['id_propiedad']) . ")' title='Editar'>
                                                <i class='fas fa-edit'></i>
                                            </button>
                                            <button class='btn btn-danger btn-sm' onclick='eliminarPropiedad(" . intval($row['id_propiedad']) . ")' title='Eliminar'>
                                                <i class='fas fa-trash'></i>
                                            </button>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No hay propiedades registradas.</td></tr>";
                            }

                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }

        // Esperar a que el documento esté cargado
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado correctamente');
            
            // Obtener el formulario
            const form = document.getElementById('form_propiedad');
            
            // Agregar el evento submit al formulario
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                console.log('Formulario enviado');
                
                // Crear objeto FormData con los datos del formulario
                const formData = new FormData(this);
                
                // Verificar si es una edición o un nuevo registro
                const isEdit = formData.get('id_propiedad') !== '';
                console.log('Es edición:', isEdit);
                
                // Si es edición y no se seleccionó una nueva imagen, no enviar el campo imagen
                if (isEdit && formData.get('imagen').size === 0) {
                    formData.delete('imagen');
                }
                
                // Mostrar los datos que se están enviando
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                
                // Realizar la petición AJAX
                fetch('process_property.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta del servidor:', data);
                    
                    if (data.status === 'success') {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: isEdit ? 'Propiedad actualizada correctamente' : 'Propiedad registrada correctamente',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.reset();
                                document.getElementById('exampleModal').querySelector('.btn-close').click();
                                location.reload();
                            }
                        });
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: error.message || 'Error al procesar la solicitud',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            });
        });

        // Agregar las funciones de los botones después del script existente
        function verPropiedad(id) {
            console.log('Intentando ver propiedad con ID:', id);
            
            fetch(`../get_property.php?id=${id}`)
                .then(response => {
                    console.log('Respuesta recibida:', response);
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                })
                .then(text => {
                    console.log('Texto recibido:', text);
                    try {
                        const data = JSON.parse(text);
                        console.log('Datos parseados:', data);
                        
                        if (data.status === 'success' && data.propiedad) {
                            Swal.fire({
                                title: data.propiedad.titulo || 'Detalles de la propiedad',
                                html: `
                                    <div class="text-start">
                                        <img src="../uploads/${data.propiedad.imagen}" alt="Imagen" style="max-width: 300px; margin-bottom: 15px; display: block; margin: 0 auto;"><br>
                                        <p><strong>Descripción:</strong> ${data.propiedad.descripcion || 'No disponible'}</p>
                                        <p><strong>Precio:</strong> ${data.propiedad.precio || 'No disponible'}</p>
                                        <p><strong>Ubicación:</strong> ${data.propiedad.ubicacion || 'No disponible'}</p>
                                        <p><strong>Contacto:</strong> ${data.propiedad.contacto || 'No disponible'}</p>
                                        <p><strong>Tipo:</strong> ${data.propiedad.tipo || 'No disponible'}</p>
                                        <p><strong>Estado:</strong> ${data.propiedad.estado || 'No disponible'}</p>
                                        <p><strong>Fecha de publicación:</strong> ${data.propiedad.fecha_publicacion || 'No disponible'}</p>
                                    </div>
                                `,
                                width: '600px',
                                showCloseButton: true,
                                showConfirmButton: false
                            });
                        } else {
                            throw new Error(data.message || 'Error al cargar los datos de la propiedad');
                        }
                    } catch (error) {
                        console.error('Error al parsear JSON:', error);
                        throw new Error('Error al procesar la respuesta del servidor');
                    }
                })
                .catch(error => {
                    console.error('Error completo:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al cargar los datos de la propiedad'
                    });
                });
        }

        function editarPropiedad(id) {
            console.log('Editando propiedad con ID:', id);
            
            fetch(`../get_property.php?id=${id}`)
                .then(response => {
                    console.log('Respuesta del servidor:', response);
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Error al obtener los datos de la propiedad');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos:', data);
                    
                    if (data.status === 'success' && data.propiedad) {
                        // Rellenar el formulario con los datos
                        const form = document.getElementById('form_propiedad');
                        
                        // Establecer los valores en los campos
                        form.querySelector('#id_propiedad').value = data.propiedad.id_propiedad;
                        form.querySelector('#titulo').value = data.propiedad.titulo || '';
                        form.querySelector('#descripcion').value = data.propiedad.descripcion || '';
                        form.querySelector('#precio').value = data.propiedad.precio || '';
                        form.querySelector('#ubicacion').value = data.propiedad.ubicacion || '';
                        form.querySelector('#contacto').value = data.propiedad.contacto || '';
                        form.querySelector('#tipo').value = data.propiedad.tipo || '';
                        form.querySelector('#estado').value = data.propiedad.estado || '';
                        form.querySelector('#fecha_publicacion').value = data.propiedad.fecha_publicacion || '';
                        
                        // Hacer el campo de imagen no requerido para edición
                        form.querySelector('#imagen').removeAttribute('required');
                        
                        // Cambiar el título del modal
                        document.querySelector('#exampleModalLabel').textContent = 'Editar Propiedad';
                        
                        // Abrir el modal
                        new bootstrap.Modal(document.getElementById('exampleModal')).show();
                    } else {
                        throw new Error(data.message || 'Error al cargar los datos de la propiedad');
                    }
                })
                .catch(error => {
                    console.error('Error completo:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al cargar los datos de la propiedad'
                    });
                });
        }

        function eliminarPropiedad(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('../delete_property.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id: id })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire(
                                '¡Eliminado!',
                                'La propiedad ha sido eliminada.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            throw new Error(data.message);
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', error.message, 'error');
                    });
                }
            });
        }

        function buscarPropiedades() {
            const precio = document.getElementById('buscarPrecio').value;
            const tipo = document.getElementById('buscarTipo').value;
            const estado = document.getElementById('buscarEstado').value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'buscar_propiedades.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const propiedades = JSON.parse(xhr.responseText);
                    const tablaBody = document.querySelector('#propertyTable tbody');
                    tablaBody.innerHTML = '';
                    propiedades.forEach(propiedad => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td><img src="../uploads/${propiedad.imagen}" alt="Imagen" width="100"></td>
                            <td>${propiedad.titulo}</td>
                            <td>${propiedad.descripcion}</td>
                            <td>${propiedad.precio}</td>
                            <td>${propiedad.ubicacion}</td>
                            <td>${propiedad.contacto}</td>
                            <td>${propiedad.tipo}</td>
                            <td>${propiedad.estado}</td>
                            <td class='text-center'>
                                <button class='btn btn-info btn-sm me-1' onclick='verPropiedad(${propiedad.id_propiedad})' title='Ver detalles'>
                                    <i class='fas fa-eye'></i>
                                </button>
                                <button class='btn btn-warning btn-sm me-1' onclick='editarPropiedad(${propiedad.id_propiedad})' title='Editar'>
                                    <i class='fas fa-edit'></i>
                                </button>
                                <button class='btn btn-danger btn-sm' onclick='eliminarPropiedad(${propiedad.id_propiedad})' title='Eliminar'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>
                        `;
                        tablaBody.appendChild(row);
                    });
                }
            };
            xhr.send(`precio=${precio}&tipo=${tipo}&estado=${estado}`);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const buscarInput = document.getElementById('buscar');
            buscarInput.addEventListener('input', buscarPropiedades);
        });

        function buscarPropiedades() {
            const buscar = document.getElementById('buscar').value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'buscar_propiedades.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const propiedades = JSON.parse(xhr.responseText);
                    const tablaBody = document.querySelector('#propertyTable tbody');
                    tablaBody.innerHTML = '';
                    propiedades.forEach(propiedad => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td><img src="../uploads/${propiedad.imagen}" alt="Imagen" width="100"></td>
                            <td>${propiedad.titulo}</td>
                            <td>${propiedad.descripcion}</td>
                            <td>${propiedad.precio}</td>
                            <td>${propiedad.ubicacion}</td>
                            <td>${propiedad.contacto}</td>
                            <td>${propiedad.tipo}</td>
                            <td>${propiedad.estado}</td>
                            <td class='text-center'>
                                <button class='btn btn-info btn-sm me-1' onclick='verPropiedad(${propiedad.id_propiedad})' title='Ver detalles'>
                                    <i class='fas fa-eye'></i>
                                </button>
                                <button class='btn btn-warning btn-sm me-1' onclick='editarPropiedad(${propiedad.id_propiedad})' title='Editar'>
                                    <i class='fas fa-edit'></i>
                                </button>
                                <button class='btn btn-danger btn-sm' onclick='eliminarPropiedad(${propiedad.id_propiedad})' title='Eliminar'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>
                        `;
                        tablaBody.appendChild(row);
                    });
                }
            };
            xhr.send(`buscar=${buscar}`);
        }
    </script>
</body>
</html>
