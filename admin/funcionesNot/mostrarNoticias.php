<?php
include("../controladores/conexion.php");

$squl = "SELECT * FROM  noticias" ;
$result = $sql ->query($squl);

echo json_encode($row = $result -> fetch_all());


?>