document.addEventListener("DOMContentLoaded", function () {
    // Cargar datos al cargar la página
    cargarDatosDashboard(); // Función para cargar datos del dashboard
    cargarDatosTabla();    // Función para cargar datos de la tabla
});

// Función para cargar datos del dashboard (tarjetas)
function cargarDatosDashboard() {
    const xhr = new XMLHttpRequest();
    const url = "../funcionesInicio/cargarDatos_dashboard.php"; // Ruta al archivo PHP

    xhr.open("GET", url, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const data = JSON.parse(xhr.responseText);

                // Actualizar las tarjetas con los datos recibidos
                document.getElementById("total-usuarios").textContent = data.total_usuarios;
                document.getElementById("propiedades-disponibles").textContent = data.propiedades_disponibles;
                document.getElementById("propiedades-ocupadas").textContent = data.propiedades_ocupadas;
                document.getElementById("total-propiedades").textContent = data.total_propiedades;

                // Actualizar la tabla si los datos incluyen HTML
                if (data.tabla_html) {
                    document.getElementById("tabla_body").innerHTML = data.tabla_html;
                }
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ocurrió un error al procesar los datos.",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ocurrió un error al cargar los datos del dashboard.",
            });
        }
    };

    xhr.onerror = function () {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Ocurrió un error en la solicitud AJAX del dashboard.",
        });
    };

    xhr.send();
}

// Función para cargar datos de la tabla
function cargarDatosTabla() {
    const xhr = new XMLHttpRequest();
    const url = "../funcionesInicio/cargar_inicio.php"; // Ruta al archivo PHP

    xhr.open("GET", url, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Insertar los datos en el tbody de la tabla
            document.getElementById("tabla_body").innerHTML = xhr.responseText;
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ocurrió un error al cargar los datos de la tabla.",
            });
        }
    };

    xhr.onerror = function () {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Ocurrió un error en la solicitud AJAX de la tabla.",
        });
    };

    

    

    xhr.send();

    
}





// Función para alternar la barra lateral
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("active");
}