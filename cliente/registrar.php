<?php
include '../conexion/conexion.php';



    mysqli_select_db($conexion, "productosbd");

    //hacemos una consulta de todos los IDS
    $consultaIds = "SELECT id
                    FROM productos
                    ORDER BY id ASC";
    //recogemos la consulta
    $resultadoConsultasIds = mysqli_query($conexion, $consultaIds);
    //capturamos en un array todos los ids de la consulta
    while($datos= mysqli_fetch_array($resultadoConsultasIds)){
        $idExistentes [] = intval($datos['id']);
    }
    //iniciamos en el valor mínimo que queremos darle al ID
    $id = 1;
    //le decimos que busque dentro del array si existe la id mínima,
    //en caso de existir le sumamos uno para que busque el siguiente
    while (in_array($id, $idExistentes)){
        $id++;
    }


    //quedan huecos por detrás si borramos un producto con id intermedio
   /* $consultaIdMax = "SELECT Max(id)
            FROM productos";
    
    $idMaxResult = mysqli_query($conexion, $consultaIdMax);
    
    $id = 1;
    while ($dato = mysqli_fetch_row($idMaxResult)){
        $idMax = $dato[0];
        $id = intval($idMax)+1;
    }*/
    
    
    
    
    $name = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
 


 
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
    INSERT INTO productos
    (id, nombre, descripcion, precio, imagen)
    VALUES ($id, '$name', '$descripcion', $precio, '$nombreArchivo')";

    mysqli_query($conexion,$insertar);

    header("Location:../cliente_estatico/alta_ok.php");


//fin del archivo registrar.php
?>
