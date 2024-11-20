<?php
    include("../Conexion/conexion.php");
    $conectar = mysqli_connect($host, $usuariodb, $clavedb, $basededatos);
    $sql="SELECT id_nombre,nombre  FROM clientes";
    $resultado=mysqli_query($conectar, $sql);
    $json_array = array();

    while ($data = mysqli_fetch_assoc($resultado)) {
        $json_array[] = $data;
    }
    echo json_encode($json_array);
?>