<?php
require 'conexion.php';
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$estado_civil = $_POST['estado_civil'];
$hijos = isset($_POST['hijos']) ? $_POST['hijos'] : 0;
$intereses = isset($_POST['intereses']) ? $_POST['intereses'] : null;
$arrayIntereses = null;
$numero_array = count($intereses);
$contador = 0;
if ($numero_array > 0) {

    foreach ($intereses as $key => $valor) {
        if ($contador != $numero_array - 1) {

            $arrayIntereses .= $valor . " ";
        } else {
            $arrayIntereses .= $valor;
            $contador++;
        }
    }
}
$consulta = "insert into personas(nombre,correo,telefono,estado_civil,hijos,intereses) values('$nombre','$email','$telefono','$estado_civil','$hijos','$arrayIntereses')";
$resultado = $conexion->query($consulta);
// procesamiento del archivo
$id_insert = $conexion->insert_id;
if ($_FILES['archivo']['error'] > 0) {

    echo "Error al subir el archivo";
} else {
    $permitidos = array("image/gif", "image/png","image/jpg","image/jpeg","application/pdf");
    $tamaña_kb = 200;

    if (in_array($_FILES['archivo']['type'], $permitidos)  && $_FILES['archivo']['size'] <= $tamaña_kb * 1024) {

        $path = "files/".$id_insert."/";
        $archivo = $path . $_FILES['archivo']['name'];
        if (!file_exists($path)) {
            mkdir($path);
        }
        if (!file_exists($archivo)) {
            $respuesta= move_uploaded_file($_FILES['archivo']['tmp_name'], $archivo);
            if ($respuesta) {
                echo "El archivo se guardo ";
            } else echo "Hubo problemas al guardar";
        } else {
            echo "archivo ya existe";
        }
    } else {
        echo "archivo no perimitido o exede de tamaño";
    }
}







?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Guardar</title>
</head>

<body>
    <div class="container">

        <?php if ($resultado) { ?>
            <h3 align="center">Usted Ha sido Registrado</h3>
        <?php } else { ?>
            <h3>NO se puedo registrar</h3>
        <?php } ?>
        <a href="nuevo.php" class="btn btn-danger">Regresar</a>



    </div>
</body>

</html>