<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);

    // Validar correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["message" => "Correo inválido"]);
        exit;
    }

    // Validar contraseña
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        echo json_encode(["message" => "La contraseña no cumple con los requisitos"]);
        exit;
    }

    // Simulación de almacenamiento en base de datos (Aquí puedes insertar en MySQL con PDO)
    echo json_encode(["message" => "Registro exitoso"]);
}
?>