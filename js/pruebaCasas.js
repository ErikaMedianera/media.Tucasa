document.addEventListener('DOMContentLoaded', function () {
    const contenedorPropiedades = document.getElementById('contenedor-propiedades');

    // Función para cargar las propiedades
    function cargarPropiedades() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../FuncionesPruebaCasa/obtener_propiedad.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.status === 200) {
                const respuesta = JSON.parse(this.responseText);

                if (respuesta.success) {
                    const propiedades = respuesta.data;

                    // Limpiar el contenedor antes de agregar nuevas propiedades
                    contenedorPropiedades.innerHTML = '';

                    // Generar el HTML para cada propiedad
                    propiedades.forEach(propiedad => {
                        const card = `
                            <div class="card col-md-3 mb-4" style="width: 20rem;">
                                <img src="../imagenes/${propiedad.imagen}" class="card-img-top" alt="${propiedad.titulo}">
                                <div class="card-body">
                                    <h5 class="card-title">${propiedad.titulo}</h5>
                                    <p class="card-text">${propiedad.descripcion.substring(0, 100)}...</p>
                                    <a href="../php/propiedad.php?id=${propiedad.id_propiedad}" class="btn btn-primary">Ver más</a>
                                </div>
                            </div>
                        `;
                        contenedorPropiedades.innerHTML += card;
                    });
                } else {
                    contenedorPropiedades.innerHTML = `<p class="text-center text-danger">${respuesta.message}</p>`;
                }
            }
        };

        xhr.onerror = function () {
            contenedorPropiedades.innerHTML = '<p class="text-center text-danger">Error al cargar las propiedades.</p>';
        };

        // Enviar solicitud POST vacía
        xhr.send('action=obtener_propiedades');
    }

    // Cargar las propiedades al cargar la página
    cargarPropiedades();
});