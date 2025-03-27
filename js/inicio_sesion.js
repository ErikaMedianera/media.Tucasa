document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma tradicional

    // Obtener los valores del formulario
    const nombre = document.getElementById('nombre').value.trim();
    const email = document.getElementById('email').value.trim();
    const contraseña = document.getElementById('contraseña').value.trim();

    // Validaciones básicas
    let isValid = true;
    document.getElementById('errornom').textContent = '';
    document.getElementById('errorema').textContent = '';
    document.getElementById('errorpas').textContent = '';

    if (!nombre) {
        document.getElementById('errornom').textContent = 'El nombre es obligatorio.';
        isValid = false;
    }

    if (!email || !validateEmail(email)) {
        document.getElementById('errorema').textContent = 'Ingrese un correo electrónico válido.';
        isValid = false;
    }

    if (!contraseña) {
        document.getElementById('errorpas').textContent = 'La contraseña es obligatoria.';
        isValid = false;
    }

    if (!isValid) return;

    // Enviar los datos al servidor usando Fetch API
    fetch('../funciones/validar_sesion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nombre, email, contraseña })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirigir al usuario a la página principal
            window.location.href = '../php/propiedad.php';
        } else {
            if (data.message === '../funciones/validar_sesion.php') {
                // Redirigir al formulario de registro
                window.location.href = '../index.php';
            } else {
                // Mostrar mensaje de error
                alert(data.message);
            }
        }
    })
    .catch(error => console.error('Error:', error));
});

// Función para validar el formato del correo electrónico
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}