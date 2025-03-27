document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM cargado, iniciando carga de servicios...');
    cargarServicios();

    // Función para alternar el sidebar
    window.toggleSidebar = function () {
        document.getElementById("sidebar").classList.toggle("active");
    };

    // Configurar el formulario de inserción
    const formulario = document.getElementById('formularioServicio');
    if (formulario) {
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log('Enviando formulario de inserción...');
            const xhr = new XMLHttpRequest();
            const formData = new FormData(this);

            // Validar campos requeridos
            const titulo = formData.get('nombre');
            const descripcion = formData.get('descripcion');
            const imagen = formData.get('imagen');

            if (!titulo || !descripcion || !imagen) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Todos los campos son requeridos'
                });
                return;
            }

            // Validar tipo de imagen
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(imagen.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El archivo debe ser una imagen (JPG, PNG o GIF)'
                });
                return;
            }

            // Enviar solicitud al servidor
            xhr.open('POST', '../funcionesServicios/crear_servicio.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Servicio registrado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Cerrar el modal
                            const modal = document.getElementById('exampleModal');
                            const modalInstance = bootstrap.Modal.getInstance(modal);
                            modalInstance.hide();
                            // Limpiar el formulario
                            formulario.reset();
                            // Recargar la tabla
                            cargarServicios();
                        } else {
                            throw new Error(data.message || 'Error al registrar el servicio');
                        }
                    } catch (error) {
                        console.error('Error al procesar respuesta:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message || 'Error al procesar la respuesta del servidor'
                        });
                    }
                } else {
                    console.error('Error en la solicitud HTTP:', xhr.status);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al comunicarse con el servidor'
                    });
                }
            };
            xhr.onerror = function () {
                console.error('Error de red');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error de conexión con el servidor'
                });
            };
            xhr.send(formData);
        });
    }

    function editarNoticia(id) {
        console.log('Editando noticia con ID:', id);
        
        if (!id) {
            console.error('ID no proporcionado');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'ID de noticia no válido'
            });
            return;
        }
    
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `../funcionesServicios/obtener_servicio.php?id=${id}`, true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
                try {
                    const noticia = JSON.parse(xhr.responseText);
                    console.log('Datos procesados:', noticia);
                    
                    // Comprobar si tenemos datos válidos
                    if (!noticia || noticia.status === 'error') {
                        throw new Error(noticia.message || 'Error al cargar la noticia');
                    }
                    
                    // Rellenar el formulario de actualización con verificación
                    const idField = document.getElementById('idServicioActualizar');
                    const tituloField = document.getElementById('tituloActualizar');
                    const descripcionField = document.getElementById('descripcionActualizar');
                    
                    
                    if (idField) {
                        idField.value = noticia.idServicio;
                    } else {
                        console.error('No se encontró el campo idNoticiaActualizar');
                    }
                    
                    if (tituloField) {
                        tituloField.value = noticia.nombre || '';
                    } else {
                        console.error('No se encontró el campo tituloActualizar');
                    }
                    
                    if (descripcionField) {
                        descripcionField.value = noticia.descripcion || '';
                    } else {
                        console.error('No se encontró el campo descripcionActualizar');
                    }
                    
                    
                    
                    // Si existe el campo de imagen, hacerlo no requerido para actualización
                    const imagenField = document.getElementById('imagenActualizar');
                    if (imagenField) {
                        imagenField.removeAttribute('required');
                    }
                    
                    // Verificar si el modal existe antes de mostrarlo
                    const modalElement = document.getElementById('actualizar');
                    if (modalElement) {
                        const modalActualizar = new bootstrap.Modal(modalElement);
                        modalActualizar.show();
                    } else {
                        console.error('El modal de actualización no existe');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se encontró el formulario de actualización'
                        });
                    }
                } catch (error) {
                    console.error('Error al procesar los datos:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al cargar la noticia'
                    });
                }
            } else {
                console.error('Error en la solicitud HTTP:', xhr.status);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al comunicarse con el servidor'
                });
            }
        };
        
        xhr.onerror = function() {
            console.error('Error de red');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error de conexión con el servidor'
            });
        };
        
        xhr.send();
    }
});

// Función para cargar servicios
function cargarServicios() {
    console.log('Cargando servicios...');
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../funcionesServicios/obtener_servicio.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const data = JSON.parse(xhr.responseText);
                const tabla = document.getElementById('tabla_body');
                if (!tabla) {
                    throw new Error('No se encontró el elemento tabla_body');
                }
                tabla.innerHTML = '';
                if (data && data.status === 'error') {
                    throw new Error(data.message || 'Error al cargar los servicios');
                }
                const servicios = Array.isArray(data) ? data : [];
                if (servicios.length === 0) {
                    tabla.innerHTML = '<tr><td colspan="4" class="text-center">No hay servicios registrados</td></tr>';
                    return;
                }
                servicios.forEach(servicio => {
                    const nombre = servicio.nombre || 'Sin título';
                    const descripcion = servicio.descripcion || 'Sin descripción';
                    const imagen = servicio.imagen || 'default.jpg';
                    const id = servicio.idServicio;
                    tabla.innerHTML += `
                        <tr>
                            <td><img src="../uploads/${imagen}" alt="Imagen" width="100" onerror="this.src='../uploads/default.jpg'"></td>
                            <td>${nombre}</td>
                            <td>${descripcion}</td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm me-1" onclick="verServicio(${id})" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm me-1" onclick="editarServicio(${id})" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="eliminarServicio(${id})" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } catch (error) {
                console.error('Error al procesar los datos:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error al cargar los servicios'
                });
            }
        } else {
            console.error('Error en la solicitud HTTP:', xhr.status);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al comunicarse con el servidor'
            });
        }
    };
    xhr.onerror = function () {
        console.error('Error de red');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión con el servidor'
        });
    };
    xhr.send();
}

// Función para eliminar un servicio
function eliminarServicio(id) {
    console.log('Eliminando servicio con ID:', id);
    if (!id) {
        console.error('ID no proporcionado');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID de servicio no válido'
        });
        return;
    }
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
            const xhr = new XMLHttpRequest();
            const formData = new FormData();
            formData.append('idServicio', id);
            xhr.open('POST', '../funcionesServicios/delete_servicio.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'Servicio eliminado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                cargarServicios();
                            });
                        } else {
                            throw new Error(data.message || 'Error al eliminar el servicio');
                        }
                    } catch (error) {
                        console.error('Error al procesar respuesta:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message || 'Error al procesar la respuesta del servidor'
                        });
                    }
                } else {
                    console.error('Error en la solicitud HTTP:', xhr.status);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al comunicarse con el servidor'
                    });
                }
            };
            xhr.onerror = function () {
                console.error('Error de red');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error de conexión con el servidor'
                });
            };
            xhr.send(formData);
        }
    });
}

// Función para ver un servicio
function verServicio(id) {
    console.log('Viendo servicio con ID:', id);
    if (!id) {
        console.error('ID no proporcionado');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID de servicio no válido'
        });
        return;
    }
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../funcionesServicios/obtener_servicio.php?id=${id}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const servicio = JSON.parse(xhr.responseText);
                if (!servicio || servicio.status === 'error') {
                    throw new Error(servicio.message || 'Error al cargar el servicio');
                }
                Swal.fire({
                    title: servicio.nombre || 'Sin título',
                    html: `
                        <div class="text-start">
                            <img src="../uploads/${servicio.imagen || 'default.jpg'}" alt="Imagen" style="max-width: 300px; margin-bottom: 15px;" onerror="this.src='../uploads/default.jpg'"><br>
                            <p><strong>Descripción:</strong> ${servicio.descripcion || 'Sin descripción'}</p>
                        </div>
                    `,
                    width: '600px',
                    showCloseButton: true,
                    showConfirmButton: false
                });
            } catch (error) {
                console.error('Error al procesar los datos:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error al cargar el servicio'
                });
            }
        } else {
            console.error('Error en la solicitud HTTP:', xhr.status);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al comunicarse con el servidor'
            });
        }
    };
    xhr.onerror = function () {
        console.error('Error de red');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión con el servidor'
        });
    };
    xhr.send();
}

// Función para editar un servicio
function editarServicio(id) {
    console.log('Editando servicio con ID:', id);
    if (!id) {
        console.error('ID no proporcionado');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID de servicio no válido'
        });
        return;
    }
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../funcionesServicios/obtener_servicio.php?id=${id}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const servicio = JSON.parse(xhr.responseText);
                if (!servicio || servicio.status === 'error') {
                    throw new Error(servicio.message || 'Error al cargar el servicio');
                }
                // Rellenar el formulario de actualización
                const idField = document.getElementById('idServicioActualizar');
                const tituloField = document.getElementById('tituloActualizar');
                const descripcionField = document.getElementById('descripcionActualizar');
                if (idField) idField.value = servicio.idServicio;
                if (tituloField) tituloField.value = servicio.nombre || '';
                if (descripcionField) descripcionField.value = servicio.descripcion || '';
                // Si existe el campo de imagen, hacerlo no requerido para actualización
                const imagenField = document.getElementById('imagenActualizar');
                if (imagenField) imagenField.removeAttribute('required');
                // Mostrar el modal de actualización
                const modalElement = document.getElementById('actualizar');
                if (modalElement) {
                    const modalActualizar = new bootstrap.Modal(modalElement);
                    modalActualizar.show();
                } else {
                    console.error('El modal de actualización no existe');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se encontró el formulario de actualización'
                    });
                }
            } catch (error) {
                console.error('Error al procesar los datos:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error al cargar el servicio'
                });
            }
        } else {
            console.error('Error en la solicitud HTTP:', xhr.status);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al comunicarse con el servidor'
            });
        }
    };
    xhr.onerror = function () {
        console.error('Error de red');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión con el servidor'
        });
    };
    xhr.send();
}

function eliminarServicio(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../funcionesServicios/eliminar_servicio.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        Swal.fire(
                            '¡Eliminado!',
                            'El servicio ha sido eliminado.',
                            'success'
                        );
                        cargarServicios();
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            };

            xhr.send(`id=${id}`);
        }
    });
}

// Función para cargar servicios
function cargarServicios() {
    console.log('Cargando servicios...');
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../funcionesServicios/obtener_servicio.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const data = JSON.parse(xhr.responseText);
                const tabla = document.getElementById('tabla_body');
                if (!tabla) {
                    throw new Error('No se encontró el elemento tabla_body');
                }
                tabla.innerHTML = '';
                if (data && data.status === 'error') {
                    throw new Error(data.message || 'Error al cargar los servicios');
                }
                const servicios = Array.isArray(data) ? data : [];
                if (servicios.length === 0) {
                    tabla.innerHTML = '<tr><td colspan="4" class="text-center">No hay servicios registrados</td></tr>';
                    return;
                }
                servicios.forEach(servicio => {
                    const nombre = servicio.nombre || 'Sin título';
                    const descripcion = servicio.descripcion || 'Sin descripción';
                    const imagen = servicio.imagen || 'default.jpg';
                    const id = servicio.idServicio;
                    tabla.innerHTML += `
                        <tr>
                            <td><img src="../uploads/${imagen}" alt="Imagen" width="100" onerror="this.src='../uploads/default.jpg'"></td>
                            <td>${nombre}</td>
                            <td>${descripcion}</td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm me-1" onclick="verServicio(${id})" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm me-1" onclick="editarServicio(${id})" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="eliminarServicio(${id})" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } catch (error) {
                console.error('Error al procesar los datos:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error al cargar los servicios'
                });
            }
        } else {
            console.error('Error en la solicitud HTTP:', xhr.status);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al comunicarse con el servidor'
            });
        }
    };
    xhr.onerror = function () {
        console.error('Error de red');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión con el servidor'
        });
    };
    xhr.send();
}
