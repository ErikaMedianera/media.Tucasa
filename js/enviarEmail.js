
document.getElementById("formulario").addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío tradicional del formulario

    // Obtener los valores del formulario
    const nombre = document.getElementById("nombre").value.trim();
    const email = document.getElementById("email").value.trim();
    const comentario = document.getElementById("textos").value.trim();

    // Validar campos vacíos
    if (!nombre || !email || !comentario) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Todos los campos son obligatorios.",
        });
        return;
    }

    // Validar formato de correo electrónico
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Por favor, ingresa un correo electrónico válido.",
        });
        return;
    }

    // Crear objeto XMLHttpRequest
    const xhr = new XMLHttpRequest();
    const url = "../funcionesContactos/enviarEmail.php"; // Ruta al archivo PHP

    // Configurar la solicitud
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
                Swal.fire({
                    icon: "success",
                    title: "Éxito",
                    text: "Tu reseña ha sido enviada correctamente.",
                }).then(() => {
                    document.getElementById("formulario").reset(); // Limpiar el formulario
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.message,
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ocurrió un error al enviar la solicitud.",
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

    // Enviar los datos al servidor
    const data = `nombre=${encodeURIComponent(nombre)}&email=${encodeURIComponent(email)}&textos=${encodeURIComponent(comentario)}`;
    xhr.send(data);
});
