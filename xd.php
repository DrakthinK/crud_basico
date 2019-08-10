<?php

for ($x = 0; $x <= 10; $x++)
{
    $array[] = $x;
    echo $array[$x]=$x."<br>";
}
$t=count($array);
echo "el tamaño del array es ".$t."<br>";

foreach (glob('files/5'."/*") as $archivos_carpeta) {
    echo "!el directorio es :".$archivos_carpeta."\n"."<br>";
}
$ruta_server="files/5";

$directorio = opendir($ruta_server);
while ($r=readdir($directorio)){
    echo $r;
}
echo $_SERVER['PHP_SELF'];

?>