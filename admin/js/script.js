document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("registerForm").addEventListener("submit", function (event) {
        event.preventDefault();

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let emailError = document.getElementById("emailError");
        let passwordError = document.getElementById("passwordError");

        emailError.textContent = "";
        passwordError.textContent = "";

        // Validar correo
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            emailError.textContent = "Ingrese un correo válido.";
            return;
        }

        // Validar contraseña
        let passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordPattern.test(password)) {
            passwordError.textContent = "La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y símbolos.";
            return;
        }

        // Enviar los datos al servidor con Fetch API
        fetch("register.php", {
            method: "POST",
            body: new FormData(document.getElementById("registerForm"))
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = "usuarios.htm"; // Redirigir a usuarios.htm
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    });
});