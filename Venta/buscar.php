<?php

//este archivo no sirve
require_once 'base_de_datos.php';
/*$codigo=$_GET['codigo'];
$sentencia = $base_de_datos->prepare("SELECT pastel FROM pasteles WHERE pastel like :keyword");

$sentencia->bindValue('keyword', '%'.$codigo.'%');
$sentencia->execute();
$result = array();
while($producto = $sentencia->fetch(PDO::FETCH_OBJ)) {
	array_push($result, $producto->pastel);
}
echo json_encode($result);*/

if (isset($_GET['term'])){
    $return_arr = array();
    try {

        $sentencia = $base_de_datos->prepare("SELECT pastel FROM pasteles WHERE pastel like :term");
        $sentencia->execute(array('term' => '%'.$_GET['term'].'%'));

        while($row = $sentencia->fetch()) {
            $return_arr[] =  $row['pastel'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


  }
?>
