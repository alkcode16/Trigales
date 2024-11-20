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

<html lang="es">
 <head>
    <meta charset="UTF-8">
     <title>TRIGALES DE ORO</title>
     <link rel="stylesheet" href="estilo_registro.css">
     <link rel="icon" type="image/png" href="../logo 2016.png">


     <?php include("../funciones/funciones.php"); ?>


  </head>
    <body>
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

    <h1>ACTUALIZAR CLIENTE</h1>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Conectado: <?php echo ' "'. $_SESSION['user'].'"'; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-register">
        <h2 class="form-titulo">ACTUALIZAR DATOS</h2>


        <div class="contenedor-inputs">
            <input type="text" maxlength="4" name="id" placeholder="ID DEL CLIENTE A MODIFICAR" class=input-100 onkeypress="return soloNumeros(event)" onpaste="return false" required>
            <br>
            <select name="tipo">
                <option>NOMBRE</option>
                <option>RFC</option>
                <option>DIRECCION</option>
                <option>OBSERVACIONES</option>
                <option>CLASIFICACION</option>
                <option>RUTA</option>
                <option>TIPO DE PAGO</option>

               <?php

                    $select = $_POST['tipo'];
                    switch($select){
                        case "NOMBRE":
                            $aux="nombre";
                        break;
                        case "RFC":
                            $aux="rfc";
                        break;
                        case "DIRECCION":
                            $aux="dir";
                        break;
                        case "OBSERVACIONES":
                            $aux="obs";
                        break;
                        case "CLASIFICACION":
                            $aux="clasif";
                        break;
                        case "RUTA":
                            $aux="ruta";
                        break;
                        case "TIPO DE PAGO":
                            $aux="tipo_pago";
                        break;

                    }

                ?>
            </select>
            <br>
            <input type="text" maxlength="50" name="dato" placeholder="DATO A MODIFICAR" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

        <input type="submit" name = "enviar" style="margin: 40px" value="      ACTUALIZAR      " class="btn-terminar" required>



         </div>
        </form>
 <br>
 <br>
 <br>
  <center><a  href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a> </center>

    </body>

</html>


<?php

if(isset($_POST['enviar'])){

        $conexion = mysqli_connect($host,$usuariodb,$clavedb,$basededatos);

                  if (!$conexion) {
                        ?>
                            <script type="text/javascript">
                              alert("Error al realizar la conexion");
                            </script>;
                        <?php
                        exit();
                    }else{

						$id_cliente=$_POST['id'];
						$dato=$_POST['dato'];

						$query ="UPDATE clientes SET $aux='$dato' WHERE id_nombre='$id_cliente'";

						if (mysqli_query($conexion, $query)) {

						?>
									<script type="text/javascript">
									alert("Se actualizaron correctamente los datos");
									</script>
						<?php
						mysqli_close($conexion);
						}
                  }
}

?>
