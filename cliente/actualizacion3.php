<?php
include '../conexion/conexion.php';
?>

<?php
    //recibo los datos que he pasado, para recuperar los datos antiguos
    $idmodificar= $_GET['idmodifica'];
    $imagenAntigua = $_GET['nombreimagen'];

    mysqli_select_db($conexion, "productosbd");

    $id = $_POST['identificador'];
    $name = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];


    $directorioSubida = "imagenes/";
    $max_file_size ="5210000";
    $extensionesValidas = array ("jpg", "png", "gif");

    if (($_FILES['imagen']['name']!="")){
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
    }

    if  ($_FILES['imagen']['name']!=""){
        $insertar = "
        UPDATE productos
        SET id = $id, nombre='$name', descripcion='$descripcion', precio=$precio, imagen='$nombreArchivo'
        WHERE id =$idmodificar
        ";
    } else {
        $insertar = "
        UPDATE productos
        SET id = $id, nombre='$name', descripcion='$descripcion', precio=$precio, imagen='$imagenAntigua'
        WHERE id =$idmodificar
        ";

    }


    mysqli_query($conexion,$insertar);

    header("Location:../cliente_estatico/actualiza_ok.php");



?>