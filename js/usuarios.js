document.addEventListener('DOMContentLoaded', function () {
    // Función para cargar los usuarios desde el backend
    function cargarUsuarios() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../funcionesUsuarios/obtener_usuario.php', true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    const tabla = document.getElementById('tabla_usuario');
                    tabla.innerHTML = ''; // Limpiar la tabla

                    response.data.forEach(usuario => {
                        agregarFilaATabla(usuario.nombre, usuario.email, usuario.contraseña);
                    });
                } else {
                    alert('Error al cargar los usuarios.');
                }
            }
        };

        xhr.send();
    }

    // Función para agregar una fila a la tabla
    function agregarFilaATabla(nombre, email, contraseña) {
        const tabla = document.getElementById('tabla_usuario');

        const fila = document.createElement('tr');

        const celdaNombre = document.createElement('td');
        celdaNombre.textContent = nombre;

        const celdaEmail = document.createElement('td');
        celdaEmail.textContent = email;

        const celdaContraseña = document.createElement('td');
        celdaContraseña.textContent = contraseña; // Considera cifrar las contraseñas por seguridad

        const celdaConfirmContraseña = document.createElement('td');
        celdaConfirmContraseña.textContent = contraseña; // Confirmación duplicada (igual que contraseña)

       

        fila.appendChild(celdaNombre);
        fila.appendChild(celdaEmail);
        fila.appendChild(celdaContraseña);
        fila.appendChild(celdaConfirmContraseña);
       

        tabla.appendChild(fila);
    }

    // Cargar usuarios cuando la página cargue
    cargarUsuarios();

    // Actualizar la tabla cada 5 segundos
    setInterval(cargarUsuarios, 5000);
});