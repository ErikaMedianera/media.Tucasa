



//  llamando al formulario
const formUsuarios = document.getElementById('formularioRegistro');
formUsuarios.addEventListener('submit', function (e){
 e.preventDefault();
 
 // creando el objeto que recoge los datos del input del formulario
 let formdata = new FormData(formUsuarios);
 
 // añadiendo los datos al objeto formdata
 let xhr = new XMLHttpRequest();
 

 //abriendo la peticion ajax
 xhr.open('POST', './funciones/formUsuarios.php', true);
 xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
       

        // selecion del formulario

const nombreImput = document.getElementById('nombre');
const emailInput = document.getElementById('email');
const passwordImput = document.getElementById('contraseña');
const confirmPasswordImput = document.getElementById('confirmcontraseña');

//mensajes de error

const nombreError = document.getElementById('errornom');
const emailError = document.getElementById('errorema');
const passwordError = document.getElementById('errorpas');
const confirmPasswordError = document.getElementById('errorConfirmpas');

//expresiones regulares
//solo letras, espacios con una lengitud entre 3 y 50
const nombreRegex = /^[a-zA-aáéíóúÁÉÍÓÚñÑ\s]{3,50}$/; 
const emailRegexr = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

// funcion de validacion


    

    let isValid = true;

    // validacion del campo nombre

    if(!nombreRegex.test(nombreImput.value)){
        nombreError.textContent = "El nombre debe contener solo letras y tener entre 3 y 50 caracteres. ";
        isValid = false;
    }else{
        nombreError.textContent = '';
    }
   
    // validacion del campo email
    if(!emailRegexr.test(emailInput.value)){
        emailError.textContent = "Por favor, ingrese un correo electronico valido ";
        isValid = false;
    }else{
        emailError.textContent = '';
    }

    // validacion del campo contrasena

    if(!passRegex.test(passwordImput.value)){
        passwordError.textContent = "La contrasena debe tener mas de 8 caracteres";
        isValid = false;
    }else{
        passwordError.textContent = '';
    }

    // validacion del campo confirmar contrasena
    if(passwordImput.value !== confirmPasswordImput.value){
        confirmPasswordError.textContent = 'Las contrasenas no coinciden.';
    }else{
        confirmPasswordError.textContent = '';
    }

    // si todo es valido, el formulario se enviara

    if(isValid){
        

        if(xhr.responseText = 'success'){
            Swal.fire({
                icon: 'success',
                title: 'Usuar5io registrado correctamente',
                text: 'usuario registrado en la base de datos'
            });
        }else if(xhr.responseText = 'error'){
            Swal.fire({
                icon: 'error',
                title: 'Error al registrar el usuario',
                text: 'Hubo un error en el registro'
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema en el envio' .xhr.responseText
            });
        }
    }


//formulario.addEventListener('submit' , validarFormulario);

    }
 } 
 xhr.send(formdata);
});

