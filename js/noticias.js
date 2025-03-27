document.addEventListener('DOMContentLoaded', function () {
    console.log('Cargando noticias...');
    cargarNoticias();
});

function cargarNoticias() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../funcionesNoticias/obtener_noticia.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 'success') {
                    mostrarNoticias(response.data);
                } else {
                    throw new Error(response.message || 'Error al cargar las noticias');
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

    xhr.send();
}

function mostrarNoticias(noticias) {
    const noticiasContainer = document.getElementById('noticias-container');
    const noticiasRecientes = document.getElementById('noticias-recientes');

    // Limpiar el contenido anterior
    noticiasContainer.innerHTML = '<h2>Noticias</h2>';
    noticiasRecientes.innerHTML = '<h2>Noticias recientes</h2>';

    if (noticias.length === 0) {
        noticiasContainer.innerHTML += '<p>No hay noticias disponibles.</p>';
        return;
    }

    noticias.forEach((noticia, index) => {
        // Mostrar noticias principales
        noticiasContainer.innerHTML += `
            <section class="bloque-seccion">
                <h3>${noticia.titulo}</h3>
                <div class="contenidos-noticia">
                    <p class="contenido">${noticia.descripcion}</p>
                </div>
                <div class="contenido-imagen">
                    <img src="../uploads/${noticia.imagen}" alt="${noticia.titulo}" width="300">
                </div>
            </section>
        `;

        // Mostrar noticias recientes
        if (index < 3) { // Solo mostrar las 3 más recientes
            noticiasRecientes.innerHTML += `
                <div class="notis-texto service">
                    <h3 class="n-servicio"><span class="number">${index + 1}</span>${noticia.titulo}</h3>
                    <p>${noticia.descripcion}</p>
                </div>
            `;
        }
    });
}