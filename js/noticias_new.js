document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, iniciando carga de noticias...');
    cargarNoticias();
    
    // Configurar función para el toggle del sidebar
    window.toggleSidebar = function() {
        document.getElementById("sidebar").classList.toggle("active");
    };
    
    // Configurar el formulario de inserción
    const formulario = document.getElementById('form_noticia');
    if (formulario) {
        formulario.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Enviando formulario de inserción...');
            
            // Crear objeto XMLHttpRequest
            const xhr = new XMLHttpRequest();
            const formData = new FormData(this);
            
            // Validar campos requeridos
            const titulo = formData.get('titulo');
            const descripcion = formData.get('descripcion');
            const fecha = formData.get('fecha_publicacion');
            
            if (!titulo || !descripcion || !fecha) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Todos los campos son requeridos'
                });
                return;
            }
            
            // Validar imagen si se seleccionó una
            const imagen = formData.get('imagen');
            if (imagen && imagen.size > 0) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(imagen.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El archivo debe ser una imagen (JPG, PNG o GIF)'
                    });
                    return;
                }
            }
            
            xhr.open('POST', '../funcionesNot/insertar_noticias.php', true);
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Respuesta del servidor:', xhr.responseText);
                    try {
                        const data = JSON.parse(xhr.responseText);
                        console.log('Datos procesados:', data);
                        
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Noticia registrada correctamente',
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
                            cargarNoticias();
                        } else {
                            throw new Error(data.message || 'Error al registrar la noticia');
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
            
            xhr.onerror = function() {
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
    
    // Configurar el formulario de actualización si existe
    const formularioActualizar = document.getElementById('formularioActualizar');
    if (formularioActualizar) {
        formularioActualizar.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Enviando formulario de actualización...');
            
            // Crear objeto XMLHttpRequest
            const xhr = new XMLHttpRequest();
            const formData = new FormData(this);
            
            xhr.open('POST', '../funcionesNot/actualizar_noticia.php', true);
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Respuesta del servidor:', xhr.responseText);
                    try {
                        const data = JSON.parse(xhr.responseText);
                        console.log('Datos procesados:', data);
                        
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Noticia actualizada correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            
                            // Cerrar el modal si existe
                            const modal = document.getElementById('actualizar');
                            if (modal) {
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();
                            }
                            
                            // Recargar la tabla
                            cargarNoticias();
                        } else {
                            throw new Error(data.message || 'Error al actualizar la noticia');
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
            
            xhr.onerror = function() {
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

    document.getElementById('buscar').addEventListener('input', buscarNoticias);
});

function cargarNoticias() {
    console.log('Cargando noticias...');
    const xhr = new XMLHttpRequest();
    
    xhr.open('GET', '../funcionesNot/get_noticia.php', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Respuesta recibida:', xhr.responseText);
            try {
                const data = JSON.parse(xhr.responseText);
                console.log('Datos recibidos:', data);
                
                const tabla = document.getElementById('tabla_body');
                if (!tabla) {
                    throw new Error('No se encontró el elemento tabla_body');
                }
                tabla.innerHTML = '';
                
                if (data && data.status === 'error') {
                    throw new Error(data.message || 'Error al cargar las noticias');
                }
                
                const noticias = Array.isArray(data) ? data : [];
                
                if (noticias.length === 0) {
                    tabla.innerHTML = '<tr><td colspan="5" class="text-center">No hay noticias registradas</td></tr>';
                    return;
                }
                
                noticias.forEach(noticia => {
                    const titulo = noticia.titulo || 'Sin título';
                    const descripcion = noticia.descripcion || 'Sin descripción';
                    const fecha = noticia.fecha_publicacion || 'Fecha no disponible';
                    const imagen = noticia.imagen || 'default.jpg';
                    const id = noticia.id_noticias;

                    tabla.innerHTML += `
                        <tr>
                            <td><img src="../uploads/${imagen}" alt="Imagen" width="100" onerror="this.src='../uploads/default.jpg'"></td>
                            <td>${titulo}</td>
                            <td>${descripcion}</td>
                            <td>${fecha}</td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm me-1" onclick="verNoticia(${id})" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm me-1" onclick="editarNoticia(${id})" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="eliminarNoticia(${id})" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } catch (error) {
                console.error('Error al procesar los datos:', error);
                const tabla = document.getElementById('tabla_body');
                if (tabla) {
                    tabla.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Error al cargar las noticias</td></tr>';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error al cargar las noticias'
                });
            }
        } else {
            console.error('Error en la solicitud HTTP:', xhr.status);
            const tabla = document.getElementById('tabla_body');
            if (tabla) {
                tabla.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Error al comunicarse con el servidor</td></tr>';
            }
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al comunicarse con el servidor'
            });
        }
    };
    
    xhr.onerror = function() {
        console.error('Error de red');
        const tabla = document.getElementById('tabla_body');
        if (tabla) {
            tabla.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Error de conexión con el servidor</td></tr>';
        }
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión con el servidor'
        });
    };
    
    xhr.send();
}

function eliminarNoticia(id) {
    console.log('Eliminando noticia con ID:', id);
    
    if (!id) {
        console.error('ID no proporcionado');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID de noticia no válido'
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
            formData.append('id_noticias', id);
            
            xhr.open('POST', '../funcionesNot/delete_noticia_new.php', true);
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Respuesta del servidor:', xhr.responseText);
                    try {
                        const data = JSON.parse(xhr.responseText);
                        console.log('Datos procesados:', data);
                        
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'Noticia eliminada correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                cargarNoticias();
                            });
                        } else {
                            throw new Error(data.message || 'Error al eliminar la noticia');
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
            
            xhr.onerror = function() {
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

function verNoticia(id) {
    console.log('Viendo noticia con ID:', id);
    
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
    xhr.open('GET', `../funcionesNot/get_noticia.php?id=${id}`, true);
    
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
                
                Swal.fire({
                    title: noticia.titulo || 'Sin título',
                    html: `
                        <div class="text-start">
                            <img src="../uploads/${noticia.imagen || 'default.jpg'}" alt="Imagen" style="max-width: 300px; margin-bottom: 15px;" onerror="this.src='../uploads/default.jpg'"><br>
                            <p><strong>Descripción:</strong> ${noticia.descripcion || 'Sin descripción'}</p>
                            <p><strong>Fecha de publicación:</strong> ${noticia.fecha_publicacion || 'Fecha no disponible'}</p>
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
    xhr.open('GET', `../funcionesNot/get_noticia.php?id=${id}`, true);
    
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
                const idField = document.getElementById('idNoticiaActualizar');
                const tituloField = document.getElementById('tituloActualizar');
                const descripcionField = document.getElementById('descripcionActualizar');
                const fechaField = document.getElementById('fechaActualizar');
                
                if (idField) {
                    idField.value = noticia.id_noticias;
                } else {
                    console.error('No se encontró el campo idNoticiaActualizar');
                }
                
                if (tituloField) {
                    tituloField.value = noticia.titulo || '';
                } else {
                    console.error('No se encontró el campo tituloActualizar');
                }
                
                if (descripcionField) {
                    descripcionField.value = noticia.descripcion || '';
                } else {
                    console.error('No se encontró el campo descripcionActualizar');
                }
                
                if (fechaField) {
                    fechaField.value = noticia.fecha_publicacion || '';
                } else {
                    console.error('No se encontró el campo fechaActualizar');
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

function buscarNoticias() {
    const query = document.getElementById('buscar').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../funcionesNot/buscar_noticias.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            const noticias = JSON.parse(xhr.responseText);
            const tablaBody = document.querySelector('#propertyTable tbody');
            tablaBody.innerHTML = '';
            noticias.forEach(noticia => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><img src="../uploads/${noticia.imagen}" alt="Imagen" width="100"></td>
                    <td>${noticia.titulo}</td>
                    <td style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${noticia.descripcion}</td>
                    <td>${noticia.fecha_publicacion}</td>
                    <td class='text-center'>
                        <button class='btn btn-info btn-sm me-1' onclick='verNoticia(${noticia.id_noticia})' title='Ver detalles'>
                            <i class='fas fa-eye'></i>
                        </button>
                        <button class='btn btn-warning btn-sm me-1' onclick='editarNoticia(${noticia.id_noticia})' title='Editar'>
                            <i class='fas fa-edit'></i>
                        </button>
                        <button class='btn btn-danger btn-sm' onclick='eliminarNoticia(${noticia.id_noticia})' title='Eliminar'>
                            <i class='fas fa-trash'></i>
                        </button>
                    </td>
                `;
                tablaBody.appendChild(row);
            });
        }
    };
    xhr.send(`query=${query}`);
}