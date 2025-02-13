<?php
include '../conexion/conexion.php';

mysqli_select_db ($conexion, 'productosbd');


$productoBorrar = $_GET['id'];
$borrar = "
    DELETE FROM productos
    WHERE id= '$productoBorrar'
";

mysqli_query($conexion, $borrar);



header('Location: ../cliente_estatico/baja_ok.php');
?>