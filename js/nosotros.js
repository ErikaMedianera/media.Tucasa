
// Cargar tarjetas al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    cargarTarjetas();
});

// Función para cargar las tarjetas desde el servidor
function cargarTarjetas() {
    const xhr = new XMLHttpRequest();
    const url = "../funcionesNosotros/cargar_tarjetas.php";

    xhr.open("GET", url, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const tarjetas = JSON.parse(xhr.responseText);
                const container = document.getElementById("tarjetas-container");

                // Verificar que el contenedor exista
                if (!container) {
                    console.error("El contenedor 'tarjetas-container' no existe.");
                    return;
                }

                // Limpiar el contenedor
                container.innerHTML = "";

                // Crear un fragmento de documento para mejorar el rendimiento
                const fragment = document.createDocumentFragment();
                tarjetas.forEach(tarjeta => {
                    const card = document.createElement("div");
                    card.className = "card tarjeta";
                    card.style.width = "15rem";
                    card.innerHTML = `
                        <img src="${tarjeta.imagen}" class="card-img-top" alt="${tarjeta.titulo}">
                        <div class="card-body">
                            <h5 class="card-title">${tarjeta.titulo}</h5>
                            <p class="card-text">${tarjeta.descripcion}</p>
                        </div>
                    `;
                    fragment.appendChild(card);
                });

                // Agregar todas las tarjetas al contenedor
                container.appendChild(fragment);
            } catch (error) {
                console.error("Error al procesar los datos:", error);
            }
        } else {
            console.error("Error al cargar las tarjetas.");
        }
    };

    xhr.onerror = function () {
        console.error("Error en la solicitud AJAX.");
    };

    xhr.send();
}