<?php
include '../conexion/conexion.php';



    mysqli_select_db($conexion, "productosbd");

    //var_dump($_POST);
    //$id = $_POST['identificador'];
    $name = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $identificadores = array();
 


 
    $directorioSubida = "../imagenes/";
    $max_file_size ="5210000";
    $extensionesValidas = array ("jpg", "png", "gif");

    if (isset($_FILES['imagen'])){
        $errores = 0;
        $nombreArchivo = $_FILES['imagen']['name'];
        $tamanoArchivo = $_FILES['imagen']['size'];
        $directorioTemp = $_FILES['imagen']['tmp_name'];
        $tipoArchivo = $_FILES['imagen']['type'];
        $arrayArchivo = pathinfo($nombreArchivo);
        $extension = $arrayArchivo ['extension'];

        if (!in_array($extension, $extensionesValidas)){
            echo 'Extensión no válida';
            $errorres = 1;
        }

        if ($tamanoArchivo>$max_file_size){
            echo "la imagen debe tener un tamaño máximo de .$max_file_size";
            $errores = 1;
        }

        if ($errores ==0){
            $nombreCompleto = $directorioSubida.$nombreArchivo;
            move_uploaded_file($directorioTemp, $nombreCompleto);
        }
        //revisar donde se sube el archivo
    }

    $insertar = "
    INSERT productos
    (id, nombre, descripcion, precio, imagen)
    VALUES (id, '$name', '$descripcion', $precio, '$nombreArchivo')";

    mysqli_query($conexion,$insertar);

    header("Location:../cliente_estatico/alta_ok.php");


//fin del archivo registrar.php
?>
