document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, iniciando carga de noticias...');
    cargarNoticias();
    
    // Configurar función para el toggle del sidebar
    window.toggleSidebar = function() {
        document.getElementById("sidebar").classList.toggle("active");
    };
    
    // Configurar el formulario de inserción
    const formulario = document.getElementById('form_nosotros');
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
            
            xhr.open('POST', '../funcionesNosotros/insertar_nosotros.php', true);
            
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
            
            xhr.open('POST', '../funcionesNosotros/actualizar_nosotros.php', true);
            
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
});

function cargarNoticias() {
    console.log('Cargando noticias...');
    const xhr = new XMLHttpRequest();
    
    xhr.open('GET', '../funcionesNosotros/obtener_nosotros.php', true);
    
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
                    const imagen = noticia.imagen || 'default.jpg';
                    const id = noticia.id_nosotros;

                    tabla.innerHTML += `
                        <tr>
                            <td><img src="../uploads/${imagen}" alt="Imagen" width="100" onerror="this.src='../uploads/default.jpg'"></td>
                            <td>${titulo}</td>
                            <td>${descripcion}</td>
                            
                            <td class="text-center">
                                <button class="btn btn-info btn-sm me-1" onclick="verNoticia(${id})" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm me-1" onclick="editarNoticia(${id})" title="Editar">
                                    <i class="fas fa-edit"></i>
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
    xhr.open('GET', `../funcionesNosotros/obtener_nosotros.php?id=${id}`, true);
    
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
    xhr.open('GET', `../funcionesNosotros/obtener_nosotros.php?id=${id}`, true);
    
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
                const idField = document.getElementById('id_nosotros');
                const tituloField = document.getElementById('titulo');
                const descripcionField = document.getElementById('descripcion');
                
                
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
                
                
                
                // Si existe el campo de imagen, hacerlo no requerido para actualización
                const imagenField = document.getElementById('imagen');
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