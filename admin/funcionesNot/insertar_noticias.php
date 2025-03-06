<?php
include("../controladores/conexion.php");



$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_publicacion = $_POST['fecha_publicacion'];
$imagen = $_FILES['imagen']['name'];



$squl = "INSERT INTO noticias values ('', '$imagen', '$titulo', '$descripcion', '$fecha_publicacion')";
$result = $sql ->query($squl);

?>