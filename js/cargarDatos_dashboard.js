document.addEventListener("DOMContentLoaded", function () {
    // Cargar datos al cargar la página
    cargarDatos();
    cargarDatosGraficas();
});

function cargarDatos() {
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

                // Actualizar la tabla
                document.getElementById("tabla_body").innerHTML = data.tabla_html;
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
                text: "Ocurrió un error al cargar los datos.",
            });
        }
    };

    xhr.onerror = function () {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Ocurrió un error en la solicitud AJAX.",
        });
    };

    xhr.send();
}

function cargarDatosGraficas() {
    const xhr = new XMLHttpRequest();
    const url = "../html/datos_graficas.php"; // Ruta al archivo PHP

    xhr.open("GET", url, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const data = JSON.parse(xhr.responseText);

                // Datos para la gráfica de barras
                const estados = data.casas_por_estado.map(item => item.estado);
                const totalPorEstado = data.casas_por_estado.map(item => item.total);

                // Crear gráfica de barras
                const ctxBarras = document.getElementById('graficaBarras').getContext('2d');
                new Chart(ctxBarras, {
                    type: 'bar',
                    data: {
                        labels: estados,
                        datasets: [{
                            label: 'Casas por Estado',
                            data: totalPorEstado,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Datos para la gráfica circular
                const tipos = data.casas_por_tipo.map(item => item.tipo);
                const totalPorTipo = data.casas_por_tipo.map(item => item.total);

                // Crear gráfica circular
                const ctxCircular = document.getElementById('graficaCircular').getContext('2d');
                new Chart(ctxCircular, {
                    type: 'doughnut',
                    data: {
                        labels: tipos,
                        datasets: [{
                            label: 'Casas por Tipo',
                            data: totalPorTipo,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ocurrió un error al procesar los datos de las gráficas.",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ocurrió un error al cargar los datos de las gráficas.",
            });
        }
    };

    xhr.onerror = function () {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Ocurrió un error en la solicitud AJAX.",
        });
    };

    xhr.send();
}

function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("active");
}
