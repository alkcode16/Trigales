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

     <?php include("../funciones/funciones.php"); ?>


     <link rel="stylesheet" href="estilo_registro.css">
     <link rel="icon" type="image/png" href="../logo 2016.png">
  </head>

    <body>
      <br>
    <h1>ACTUALIZAR PRODUCTO</h1>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Conectado: <?php echo ' "'. $_SESSION['user'].'"'; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-register">
        <h2 class="form-titulo">ACTUALIZAR PRECIOS</h2>


        <div class="contenedor-inputs">
            <input type="text" maxlength="04" onkeypress="return soloNumeros(event)" name="id" placeholder="ID PRODUCTO A MODIFICAR" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"><br><br>


            <select name="precio">
                <option>SELECCIONE UNA OPCIÓN</option>
                <option>PRECIO DE MAYOREO</option>
                <option>PRECIO MEDIO</option>
				        <option>PRECIO EVENTUAL</option>
                <option>PRECIO TEMPORADA</option>
                <option>PRECIO DE MENUDEO</option>

               <?php

                    $select = $_POST['precio'];
                    switch($select){
                        case "PRECIO DE MAYOREO":

                            $campo="p_mayoreo";
                        break;
                        case "PRECIO MEDIO":

                            $campo="p_medio";
                        break;
						            case "PRECIO EVENTUAL":

                            $campo="p_eventual";
                        break;
                        case "PRECIO TEMPORADA":

                            $campo="p_temporada";
                        break;
                        case "PRECIO DE MENUDEO":

                            $campo="p_menudeo";
                        break;
                        default:
                    ?>
                        <script type="text/javascript">
                         alert("SELECIONE UNA OPCION");
                    </script>
                <?php

                    }

                ?>
            </select>

            <input type="text" maxlength="50" name="dato" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="PRECIO A MODIFICAR" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">




        <input type="submit" name="enviar" style="margin: 40px" value="ACTUALIZAR" class="btn-terminar" required>

         </div>
        </form>
        <br>
        <br>

    </body>
    <center>  <a href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a>  </center>
</html>


<?php

if(isset($_POST['enviar'])){


                  if (!$conexion) {
                        ?>
                            <script type="text/javascript">
                            alert("Error al realizar la conexión");
                            </script>
              <?php

                        exit();
                    }else{
                    $id_pastel=$_POST['id'];
                    $dato=$_POST['dato'];

                    $query ="UPDATE pasteles SET $campo='$dato' WHERE id_producto='$id_pastel'";

                    if (mysqli_query($conexion, $query)) {

			  ?>

                                <script type="text/javascript">
                                alert("Se actualizaron correctamente los datos");
                                </script>';
<?php
                    mysqli_close($conexion);
                    }
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
