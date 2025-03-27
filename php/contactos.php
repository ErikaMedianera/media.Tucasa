<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/contactos.css">
    <title>Document</title>
</head>
<body>
    <!--COMIENZO DE LA PARTE DEL HEADER-->
   <header class="encabezado">
       
       <nav class="navbar navbar-expand-lg bg-body-tertiary ">
     <div class="container-fluid">
       <a class="navbar-brand logo" href="#"><span class="tu">Tu</span>Casa</a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse  navegacion" id="navbarNavDropdown">
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="../index.php">Inicio</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="./pruebacasas.php">Servicios</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="./nosotros.php">Nosotros</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="./contactos.php">Contactos</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="./noticia.php">Noticias</a>
           </li>
           <li class="nav-item dropdown">
           <div class="search-container">
                <button class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input type="text" class="search-input" placeholder="Buscar...">
               </div>
           </li>
         </ul>
       </div>
      
     </div>
   </nav>
   </nav>
           
  </header> 
  <!--FIN DE LA PARTE DEL HEADER-->

<div class="container-fluid">
  
  <!--comienzo de contactos-->
  <div class="container contactos-contac">
    <h1>Redes Sociales</h1>
    <div class="row">
        <div class="col">
            <a href="https://wa.me/1234567890" target="_blank" style="text-decoration: none;">
                <i class="fa-brands fa-whatsapp" style="font-size: 2rem; color: #25D366;"></i>
            </a>
            <h5>WhatsApp</h5>
            <p>Contáctanos por WhatsApp</p>
        </div>
        <div class="col">
            <a href="https://www.facebook.com/tuperfil" target="_blank" style="text-decoration: none;">
                <i class="fa-brands fa-facebook" style="font-size: 2rem; color: #1877F2;"></i>
            </a>
            <h5>Facebook</h5>
            <p>Síguenos en Facebook</p>
        </div>
        <div class="col">
            <a href="https://www.instagram.com/tuperfil" target="_blank" style="text-decoration: none;">
                <i class="fa-brands fa-instagram" style="font-size: 2rem; color: #E4405F;"></i>
            </a>
            <h5>Instagram</h5>
            <p>Síguenos en Instagram</p>
        </div>
    </div>
</div>
  <!--fin de contactos-->
  <!--mapa y formulario de registro-->
  <div class="container secciones">
   <div class="seccion-mapa">
    <img src="../imagenes/mapa.jpg" alt="">
   </div>

   
   <form class="formulario" id="formularioEmail" method="POST">
    <div class="mb-3">
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
        <div id="errornom" class="form-text"></div>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        <div id="erroremail" class="form-text"></div>
    </div>
    <div class="mb-3">
        <textarea class="form-control" id="texto" name="texto" rows="5" placeholder="Mensaje" required></textarea>
    </div>
    <button type="button" class="btn btn-primary" onclick="submitEmail()">Enviar</button>
</form>
   
  </div>
  <!--mapa y formulario de registro-->
</div>

<!--PARTE DEL FOOTER-->

<footer>
      <div class="container-fluid footer">
        <div class="footers">
        <a href="">Inicio</a>
        <a href="">Servicios</a>
        <a href="">Contcatoc</a>
        <a href="">Nosotros</a>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, dicta?</p>
      </div>
    </footer>
    
    
    <!--FIN DE LA PARTE DEL FOOTER-->
   
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/input.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        function submitEmail() {
            const formData = new FormData(document.getElementById('formularioEmail'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', './insertar_email.php', true);
            xhr.onload = function () {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                        });
                        document.getElementById('formularioEmail').reset(); // Limpiar el formulario
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                } catch (e) {
                    console.error('Error al procesar la respuesta del servidor:', e);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde.',
                    });
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>