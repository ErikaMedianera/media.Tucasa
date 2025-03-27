<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Imagen de fondo */
        body {
            background: url('./imagenes/14.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Capa de opacidad */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo negro con opacidad */
            z-index: -1;
        }

        /* Contenedor del formulario */
        .form-container {
            max-width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Inicio de Sesión</h2>
        <form id="formLogin">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" value="" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" value="" required>
            </div>
            <button type="button" class="btn btn-primary w-100" onclick="iniciarSesion()">Iniciar Sesión</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function iniciarSesion() {
            const formData = new FormData(document.getElementById('formLogin'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', './html/verificar_usuarios.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                        }).then(() => {
                            document.getElementById('formLogin').reset(); // Limpiar el formulario
                            window.location.href = './html/index.php'; // Redirigir al index.php dentro de html
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                        document.getElementById('formLogin').reset(); // Limpiar el formulario en caso de error
                    }
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>