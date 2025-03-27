<?php
session_start();
include '../controladores/conexion.php';

// Verificar si el usuario tiene la sesión activa y es superadministrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    echo json_encode(['success' => false, 'message' => 'Acceso denegado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $rol = $_POST['rol'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($contraseña) || empty($rol)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Validar que el correo no esté registrado
    $query = "SELECT id_usuarios FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El correo ya está registrado.']);
        exit;
    }

    // Encriptar la contraseña
    $contraseñaEncriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ssss", $nombre, $email, $contraseñaEncriptada, $rol);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuario creado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear el usuario.']);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f9fa;
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
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
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
                            window.location.href = './html/index.php'; // Redirigir al index.php dentro de html
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>