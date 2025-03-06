<?php
$host = "localhost";
$usuario = "root";
$basedatos = "tucasa";
$password = "";

$sql = new mysqli($host, $usuario, $password, $basedatos);
if($sql ->connect_error){
    echo "No se pudo conectar al servidor" .$sql ->connect_error;
    exit();
}else{
   // echo "Conexion exitosa.";
}
?>