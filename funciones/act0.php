<?php
include("../Conexion/conexion.php");
$query ="UPDATE pastelesstock SET stockRuta1=0, stockRuta2=0";
$conexion = mysqli_connect($host,$usuariodb,$clavedb,$basededatos);
$resultado = mysqli_query($conexion, $query);
if ($resultado) {
?>
    <script type="text/javascript">
    alert("Se actualizaron correctamente los datos");
  </script>;
<?php
$conexion->close();
}else {
?>
    <script type="text/javascript">
      alert("Error al reiniciar los valores");
    </script>
<?php
}

 ?>
