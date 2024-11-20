<?php
session_start();
    require_once("../Conexion/conexion.php");

       if($_SESSION['user']==null || $_SESSION['user']==''){
         echo '<br>';
         echo '<br>';
         echo '<center> Usted no tiene autorización </center>';
         echo '<br>';
         echo '<br>';
         echo '<center> Inicie sesión de forma correcta </center>';
         echo '<br>';
         echo '<br>';
        echo '<center><a href="../index.php">Iniciar sesión</a></center>';
         die();
         //require_once("../Conexion/autorizacion.php");
       }

?>


<DOCTIPE html>
<html lang="es">
 <head>
    <meta charset="UTF-8">
     <title>TRIGALES DE ORO</title>
     <link rel="icon" type="image/png" href="../logo 2016.png">

     <?php include("../funciones/funciones.php"); ?>

     <link rel="stylesheet" href="estilo_registro.css">

  </head>
    <body>
    <h1>REGISTRO DE CLIENTES</h1>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Conectado: <?php echo ' "'. $_SESSION['user'].'"'; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-register">
        <h2 class="form-titulo">INGRESE DATOS DEL CLIENTE</h2>
        <div class="contenedor-inputs">
            <input type="text" maxlength="50" name="nombre" placeholder="NOMBRE" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <input type="text" maxlength="13" name="rfc" placeholder="RFC" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" title="Acepta 13 caracteres alfanumericos">
            <input type="text" maxlength="100" name="dir" placeholder="DIRECCIÓN" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <input type="text" maxlength="50" name="obs" placeholder="OBSERVACIONES  (ES OPCIONAL)" class=input-100 style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">


            <input type="text" maxlength="01" name="clasif" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="CLASIFICACION(1,2,3 ó 4)" class=input-10 required>
            <input type="text" maxlength="01" name="ruta" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="RUTA (1 Ó 2)" class=input-10 required>
            <input type="text" maxlength="07" name="tipo_pago" placeholder="CREDITO Ó CONTADO" class=input-10 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <input type="submit" name = "enviar" value="REGISTRAR CLIENTE" class="btn-registrar" required>

         </div>
        </form>
        <br>
        <br>
          <center><a  href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a> </center>
          <br>
     </body>
</html>

<script type="text/javascript">

    window.onload = function Salida(){
      setTimeout('ejecutar()',hora());

    }

    function hora(){
        horaActual=new Date();
        horaProgramada=new Date();
        horaProgramada.setHours(23);
        horaProgramada.setMinutes(55);
        horaProgramada.setSeconds(0);
        return horaProgramada.getTime() - horaActual.getTime();

    }

    function ejecutar(){
      hora();
      if (hora()==0) {
        window.location=("../Salida/salidaReporte.php");
        //alert('que pedo prro');
      }else {

      }
    }
</script>

<?php
    if(isset($_POST['enviar'])){


      if (!$conexion) {
?>
          <script type="text/javascript">
            alert("Error al realizar la conexión");
          </script>';
<?php
        exit();
      }



  $nom_cte=addslashes($_POST['nombre']);
  $rfc_cte=addslashes($_POST['rfc']);
  $dir=addslashes($_POST['dir']);
  $obs=addslashes($_POST['obs']);
  $clasif=addslashes($_POST['clasif']);
  $ruta=addslashes($_POST['ruta']);
  $tipo_pago=addslashes($_POST['tipo_pago']);


       $query = "INSERT INTO clientes (nombre,rfc,dir,obs,clasif,ruta,tipo_pago) VALUES ('$nom_cte','$rfc_cte','$dir','$obs','$clasif','$ruta','$tipo_pago')";

       if (mysqli_query($conexion, $query)) {

?>
            <script type="text/javascript">
            alert("Se insertaron correctamente los datos");
            </script>
<?php
            mysqli_close($conexion);
        }else {
?>
            <script type="text/javascript">
            alert("Error al insertar los datos\n Se insertaron datos existentes");
            </script>
<?php

        }
  }

?>

<script type="text/javascript">

window.onload = function Salida(){
  setTimeout('ejecutar()',hora());

}

function hora(){
    horaActual=new Date();
    horaProgramada=new Date();
    horaProgramada.setHours(0);
    horaProgramada.setMinutes(18);
    horaProgramada.setSeconds(0);
    return horaProgramada.getTime() - horaActual.getTime();

}

function ejecutar(){
  hora();
  if (hora()==0) {
    window.location=("../Salida/salidaReporte.php");
    //alert('que pedo prro');
  }else {

  }
}
</script>
