<?php
    $host="localhost";
    $basededatos="pasteleria";
    $usuariodb="root";
    $clavedb="";

    //$conexion = mysqli_connect($host,$usuariodb,$clavedb,$basededatos);
    $conexion = new mysqli($host, $usuariodb, $clavedb, $basededatos);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

?>
