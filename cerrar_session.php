<?php
session_start();
include("Conexion/conexion.php");
$conexion = mysqli_connect($host,$usuariodb,$clavedb,$basededatos);
$query ="UPDATE pastelesstock SET stockRuta1=0, stockRuta2=0";

$resultado = mysqli_query($conexion, $query);

  if ($resultado) {
    $conexion->close();
    session_destroy();
    header("Location: index.php");
  }else {
?>
<script type="text/javascript">alert("Error al reiniciar los valores");</script>
<?php
    header("Location: Menu2.php");
  }

?>
