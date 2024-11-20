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
        echo '<center><a href="./index.php">Iniciar sesión</a></center>';
        die();
        //require_once("../Conexion/autorizacion.php");
      }
 ?>

<DOCTIPE html>
<html lang="es">
 <head>
    <meta charset="UTF-8">
     <title>TRIGALES DE ORO</title>

     <script>
        function soloNumeros(e){
            key=e.keyCode || e.which;
            teclado=String.fromCharCode(key);
            numeros="0123456789.";
            especiales="8-37-38-46";//array
            teclado_especial=false;

            for(var i in especiales){
                if(key==especiales[i]){
                    teclado_especial=true;
                }
            }

            if(numeros.indexOf(teclado)==-1 && !teclado_especial){
                return false;

            }
        }
     </script>

     <link rel="stylesheet" href="estilo_registro_pasteles.css">
     <link rel="icon" type="image/png" href="../logo 2016.png">
  </head>
    <body>
    <h1>REGISTRO DE PASTEL</h1>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Conectado: <?php echo ' "'. $_SESSION['user'].'"'; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-register-pastel">
        <h2 class="form-titulo-pastel">PASTEL</h2>
        <div class="contenedor-inputs">

            <input type="text" maxlength="50" name="nombre_pastel" paste="off" placeholder="NOMBRE DEL PASTEL" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <input type="text" maxlength="50" name="id" onkeypress="return soloNumeros(event)" placeholder="ID DEL PRODUCTO" class=input-100 style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            <input type="text" maxlength="50" name="linea" placeholder="LINEA" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <input type="text" maxlength="05" name="p_may" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="PRECIO DE MAYOREO" class=input-10 required>
            <input type="text" maxlength="05" name="p_medio" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="PRECIO MEDIO" class=input-10 required>
            <input type="text" maxlength="05" name="p_event" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="PRECIO EVENTUAL" class=input-10 required>
            <input type="text" maxlength="05" name="p_temp" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="PRECIO DE MENUDEO" class=input-10 required>
            <input type="text" maxlength="05" name="p_men" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="PRECIO DE TEMPORADA" class=input-10 required>

            <input type="submit" name="enviar" value="REGISTRAR PRODUCTO" class="btn-registrar" required>



         </div>
        </form>
        <br>
        <br>
      <center>  <a href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a>  </center>
       <br>
       <br>
       <br>
    </body>

</html>


<?php



if(isset($_POST['enviar'])){

    if (!$conexion) {
?>
      <script type="text/javascript">
      alert("Error al realizar la conexion");
      </script>';
<?php
        exit();
    }


			$nombre=addslashes($_POST['nombre_pastel']);
			$id=addslashes($_POST['id']);
			$linea=addslashes($_POST['linea']);
			$mayoreo=addslashes($_POST['p_may']);
			$medio=addslashes($_POST['p_medio']);
			$eventual=addslashes($_POST['p_event']);
      $temporada=addslashes($_POST['p_temp']);
			$menudeo=addslashes($_POST['p_men']);



      $query="INSERT INTO pasteles(id_producto,pastel,linea,p_mayoreo,p_medio,p_eventual,p_temporada,p_menudeo) VALUES ('$id','$nombre','$linea','$mayoreo','$medio','$eventual','$temporada','$menudeo')";

			 if (mysqli_query($conexion, $query)){

?>
  				<script type="text/javascript">
  					alert("Se insertaron correctamente los datos");
  				</script>
<?php
				  mysqli_close($conexion);
      }else{
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
