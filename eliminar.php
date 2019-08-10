<?php
require 'conexion.php';
$id = $_GET['id_eli'];
$consulta = "delete from personas where id='$id'";
$resultado = $conexion->query($consulta);
delete('files/' . $id);

//eliminar con todo los files
function delete($carpeta)
{
    foreach (glob($carpeta."/*") as $archivos_carpeta) {
        if (is_dir($archivos_carpeta)) {
            delete($archivos_carpeta);
        } else {
            unlink($archivos_carpeta);
        }
    }
    rmdir($carpeta);
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
            <h3 align="center">Registro eleminado </h3>
        <?php } else { ?>
            <h3> Error a los eliminar </h3>
        <?php } ?>
        <a href="index.php" class="btn btn-danger">Regresar</a>



    </div>
</body>

</html>