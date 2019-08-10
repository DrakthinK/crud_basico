<?php
require 'conexion.php';
$where = "";
if (!empty($_POST)) {
    $valor = $_POST['campo'];
    if (!empty($valor)) {
        $where = "WHERE nombre like '%$valor%'";
    }
}
$sql=" select * from personas $where";
$resultado=$conexion->query($sql);

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

    <title>PERSONAL</title>
</head>

<body>
    <div class="container">

        <h2 align="center">PESONAL DE FACEBOOK</h2>


        <div class="row">
            <a href="nuevo.php" class="btn btn-primary">Nuevo Registro</a>
        </div>
        <br>
        <div class="row">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <b>Nombre: </b><input type="text" id="campo" name="campo">
                <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info">
            </form>
        </div>
        <br>
        <div class="row table-responsive">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th> ID</th>
                        <th>Nombre </th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Estado Civil</th>
                        <th>Hijos</th>
                        <th>Intereses</th>
                        <th>Editar</th>
                        <th>eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_array()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['correo']; ?></td>
                            <td><?php echo $row['telefono']; ?></td>
                            <td><?php echo $row['estado_civil']; ?></td>
                            <td><?php echo $row['hijos']; ?></td>
                            <td><?php echo $row['intereses']; ?></td>
                            <td><a href="editar.php?id=<?php echo $row['id']; ?>"><i class="material-icons">edit</i></a></td>
                            <td><a href="#" data-href="eliminar.php?id_eli=<?php echo $row['id']; ?> " data-toggle="modal" data-target="#confirm-delete">
                                    <i class="material-icons">delete_outline</i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
                </div>

                <div class="modal-body">
                    ¿Desea eliminar este registro?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
            
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>


</body>

</html>