<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script defer src="../js/script.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        form { width: 300px; margin: 50px auto; }
        input, button { width: 100%; margin: 10px 0; padding: 8px; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <form id="registerForm">
        <h2>Registro de Usuario</h2>
        <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
        <div id="emailError" class="error"></div>
        
        <input type="password" id="password" name="password" placeholder="Contraseña" required>
        <div id="passwordError" class="error"></div>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>