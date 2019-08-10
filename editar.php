<?php
require 'conexion.php';
$id = $_GET['id'];
$sql = "select  * from personas where id='$id' ";
$result = $conexion->query($sql);
$row = $result->fetch_array();

?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                $('.delete').click(function(){
                    var parent = $(this).parent().attr('id');
                    var service = $(this).parent().attr('data');
                    var dataString='id='+ service;

                    $.ajax({
                        type: "POST",
                        url:"del_file.php",
                        data: dataString,
                        success: function(){
                            location.reload();
                        }
                    });
                });
            });
    

    </script>

    <title>Nuevo</title>
</head>

<body>
    <div class="container">

        <h3 align="center">MODIFICAR REGISTRO</h3>


        <form class="form-horizontal" method="POST" action="update.php" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre'] ?>" required>
                </div>
            </div>
            <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['correo'] ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono'] ?>" placeholder="Telefono">
                </div>
            </div>

            <div class="form-group">
                <label for="estado_civil" class="col-sm-2 control-label">Estado Civil</label>
                <div class="col-sm-10">
                    <select class="form-control" id="estado_civil" name="estado_civil">
                        <option value="SOLTERO" <?php if ($row['estado_civil'] == 'SOLTERO') echo "selected"; ?>>SOLTERO</option>
                        <option value="CASADO" <?php if ($row['estado_civil'] == 'CASADO') echo "selected"; ?>>CASADO</option>
                        <option value="OTRO" <?php if ($row['estado_civil'] == 'OTRO') echo "selected"; ?>>OTRO</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="hijos" class="col-sm-2 control-label">¿Tiene Hijos?</label>

                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" id="hijos" name="hijos" value="1" <?php if ($row['hijos'] == '1') echo "checked"; ?>> SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" id="hijos" name="hijos" value="0" <?php if ($row['hijos'] == '0') echo "checked"; ?>> NO
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="intereses" class="col-sm-2 control-label">INTERESES</label>

                <div class="col-sm-10">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Libros" <?php if (strpos($row['intereses'], "Libros") !== false) echo 'checked'; ?>> Libros
                    </label>

                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Musica" <?php if (strpos($row['intereses'], "Musica") !== false) echo 'checked'; ?>> Musica
                    </label>

                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Deportes" <?php if (strpos($row['intereses'], "Deportes") !== false) echo 'checked'; ?>> Deportes
                    </label>

                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Otros" <?php if (strpos($row['intereses'], "Otros") !== false) echo 'checked'; ?>> Otros
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Archivo</label>
                <div class="col-sm-10">
                    <input type="file" id="archivo" name="archivo">
                    <?php

                    $ruta_server = "files/". $id;
                    if (file_exists($ruta_server)) {
                        $directorio = opendir($ruta_server);
                        while ($archivo = readdir($directorio)) {
                            if (!is_dir($archivo)) {
                                echo "<div data='".$ruta_server ."/".$archivo.
                                    "'><a href ='". $ruta_server . "/". $archivo."'
                                     title='Ver Archivo Adjunto'><i class='material-icons'> 
                                     description
                                     </i></a>";
                                echo "$archivo <a href='#' class='delete'
                                    title='Eliminar Archivo'><i class='material-icons'>delete_outline</i>
                                    </a></div> ";
                                echo "<img src='files/$id/$archivo' width='300'/>";
                            }
                        }
                    }

                    ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="index.php" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>