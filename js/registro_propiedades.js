document.getElementById('form_propiedad').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita el envío tradicional del formulario

    // Obtener los valores del formulario
    const formData = new FormData(this);
    const url = '../funcionesPropiedades/guardar_propiedad.php'; // Ruta al archivo PHP que procesa los datos

    // Mostrar confirmación con SweetAlert2
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Se guardará la propiedad en la base de datos.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar datos mediante AJAX
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Guardado', data.message, 'success');
                    document.getElementById('form_propiedad').reset(); // Limpiar el formulario
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Ocurrió un error inesperado.', 'error');
            });
        }
    });
});