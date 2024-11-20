<?php
session_start();
error_reporting(0);
require_once("Conexion/conexion.php");
if ($_SESSION['user'] == null || $_SESSION['user'] == '') {
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
<!DOCTYPE html>
<html>

<head>

  <?php include("funciones/funciones.php"); ?>

  <title>Menú TRIGALES DE ORO</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="logo 2016.png">
</head>
<style>
  .dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0;
  }

  .nav-link:hover {
    background-color: rgb(255, 196, 0);
    border-radius: 30px;
    color: black !important;
    transition: 1s;

  }
</style>

<body onload="deshabilitaRetroceso()" style="background:#23B835">

  <!-- <ul>
   <li><a href="#EL SABOR DE LA CALIDAD">Inicio</a></li>
   <li class="dropdown">
     <a href="javascript:void(0)" class="dropbtn">Clientes</a>
     <div class="dropdown-content">
       <a href="Clientes/Registro.php">Registrar Clientes</a>
       <a href="Clientes/muestraClientes.php">Mostrar todos los Clientes</a>
       <a href="Clientes/Actualizar_clientes.php">Modificar Clientes</a>
     </div>
   </li>
   <li class="dropdown">
     <a href="javascript:void(0)" class="dropbtn">Pasteles</a>
     <div class="dropdown-content">
       <a href="Pasteles/Pasteles.php">Registrar Pastel</a>
       <a href="Pasteles/muestraPasteles.php">Mostrar todos los Pasteles</a>
       <a href="Pasteles/ActualizarPrecios.php">Modificar Pasteles</a>
        <a href="Pasteles/detalleRegistro.php">Ver detalles del Articulo</a>
             Agregamos la linea de rellenos 
       <a href="Rellenos/registroRellenos.php">Registrar Relleno</a>
       <a href="Rellenos/muestraRellenos.php">Mostrar Rellenos</a>
     </div>
   </li>


   <li class="dropdown">
     <a href="javascript:void(0)" class="dropbtn">Ventas</a>
     <div class="dropdown-content">
       <a href="VentaAClientes/elegir.php">Hacer Venta a Clientes</a>
       <a href="./redireccionar.php">Venta de Mostrador</a>
      <a href="Pasteles/ventas.php">Mostrar Ventas</a>
     </div>
   </li>

   <li class="dropdown">
     <a href="javascript:void(0)" class="dropbtn">Salida</a>
     <div class="dropdown-content">
       <a href="Salida/salida.php">Mostrar Salida</a>
       <a href="Salida/salidaReporte.php">Descargar PDF</a>
     </div>
   </li>
   <li class="dropdown">
     <a href="javascript:void(0)" class="dropbtn">Detalle</a>
     <div class="dropdown-content">
       <a href="Reportes/totalVentas.php">Ventas del día</a>
     </div>
   </li>

   <li style="float:right"><a onclick="myFunction2()">Salir</a></li>
 </ul> -->
  <!-- Menu dropdown -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand mx-4" href="#">
      <img src="./logo 2016.ico" alt="" width="30" height="24">
    </a>
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Trigales de Oro</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Clientes
            </a>
            <ul class="dropdown-menu menu_content" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="Clientes/Registro.php">Registrar Clientes</a></li>
              <li><a class="dropdown-item" href="Clientes/muestraClientes.php">Mostrar todos los Clientes</a></li>
              <li><a class="dropdown-item" href="Clientes/Actualizar_clientes.php">Modificar Clientes</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pasteles
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="Pasteles/Pasteles.php">Registrar Pastel</a></li>
              <li><a class="dropdown-item" href="Pasteles/muestraPasteles.php">Mostrar todos los Pasteles</a></li>
              <li><a class="dropdown-item" href="Rellenos/registroRellenos.php">Registrar Relleno</a></li>
              <li><a class="dropdown-item" href="Rellenos/muestraRellenos.php">Mostrar Rellenos</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ventas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="VentaAClientes/elegir.php">Hacer Venta a Clientes</a></li>
              <li><a class="dropdown-item" href="./redireccionar.php">Venta de Mostrador</a></li>
              <li><a class="dropdown-item" href="Pasteles/ventas.php">Mostrar Ventas</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Salida
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="Salida/salida.php">Mostrar Salida</a></li>
              <li><a class="dropdown-item" href="Salida/salidaReporte.php">Descargar PDF</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Detalle
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="Reportes/totalVentas.php">Ventas del día</a></li>
            </ul>
          </li>
        </ul>

      </div>
      <form class="d-flex">
        <a class="btn btn-outline-danger" onclick="myFunction2()">Salir</a>
      </form>
    </div>
  </nav>
  <div class="container mt-5">
    <p> Bienvenido Usuario "<?php echo $_SESSION['user']; ?>"</p>
    <h1 class="text-center">TRIGALES DE ORO ®</h1>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 mt-5 text-center">
        <a href="ds/ea.php"><img src="logo 2016.png" width="200"></a>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <marquee class="mt-5 display-4">¡EL SABOR DE LA CALIDAD!</marquee>

</body>

<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
  window.onload = function Salida() {
    setTimeout('ejecutar()', hora());

  }

  function hora() {
    horaActual = new Date();
    horaProgramada = new Date();
    horaProgramada.setHours(17);
    horaProgramada.setMinutes(16);
    horaProgramada.setSeconds(30);
    return horaProgramada.getTime() - horaActual.getTime();

  }

  function ejecutar() {
    hora();
    if (hora() == 0) {
      window.location = ("Salida/salidaReporte.php");
      //alert('que pedo prro');
    } else {

    }
  }
</script>

</html>