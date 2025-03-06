window.onload = e => {
    function insertar() {
        const formulario = document.getElementById('formulario');
        formulario.addEventListener('submit', e => {
            e.preventDefault();
   
            let xhr = new XMLHttpRequest();
            let formdata = new FormData(e.currentTarget);
    
            xhr.open("POST", "../funcionesNot/insertar_noticias.php", true);
    
            xhr.onreadystatechange = e => {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        console.log(xhr.responseText);
                        let tabla = document.getElementById('tabla_body');
                        formulario.reset();
                        tabla.innerHTML = " ";
                        mostrardatos();
                        
                        Swal.fire({
                            title: "Éxito!",
                            text: "Noticia insertada correctamente!",
                            icon: "success",
                            confirmButtonText: "Aceptar"
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "No se pudo insertar la noticia.",
                            icon: "error",
                            confirmButtonText: "Cerrar"
                        });
                    }
                }
            }
    
            xhr.send(formdata); 
        });
    }
    
    function mostrardatos() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../funcionesNot/mostrarNoticias.php", true);
    
        xhr.onreadystatechange = e => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let datos = JSON.parse(xhr.responseText);
                let tabla = document.getElementById('tabla_body');
                tabla.innerHTML = "";
                
                datos.forEach(element => {
                    tabla.innerHTML += `
                        <tr>
                            <td>${element[1]}</td>
                            <td>${element[2]}</td>
                            <td>${element[3]}</td>
                            <td>${element[4]}</td>
                            <td>
                                <a href="#" class="btn btn-info"><i class="fa-regular fa-eye"></i></a>
                                <a href="#" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });
            }
        }
    
        xhr.send(); 
    }
    
    mostrardatos();
    insertar();
}
