<?php
$conexion = new mysqli('localhost', 'root', '', 'usu');
if ($conexion->connect_error) {
    die('Error al conectar la base de datos' . $conexion->connect_error);
}
// else echo "conexion exitosa en " . $conexion->server_info;

?>
