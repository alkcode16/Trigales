<?php
require("../fpdf/fpdf.php");
session_start();
error_reporting(0);
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

if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];

require("../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.piezasVen, ventas.fecha, ventas.id,ventas.nombre,ventas.pago,ventas.rfc,ventas.direccion,ventas.obs, GROUP_CONCAT(productos_vendidos.cantidad, '..', pasteles.pastel, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC LIMIT 1");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);

//INICIO DE LA HOJA 1

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);
$pdf->SetAutoPageBreak(true,2);
$pdf->SetTextColor(255,0,0);
//$pdf->Image('../0001.jpg','0','0','210','297','JPG');
foreach ($ventas as $venta) {

  if ($venta->pago=="CONTADO") {
      $dias="1 days";
  }else {
      $dias="8 days";
  }
  setlocale(LC_ALL,"es_ES");
  $dia = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
  //echo "Buenos d&iacute;as, hoy es ".$dia[strtotime("1 days",date("w"))];

  $caracter="$venta->total";
  $tam = strlen($caracter);
  if (substr($caracter, -2)==".5"){

    $cadena="5";
    $ventaTotal=$venta->total."0";
  }else {
    $cadena="0";
    $ventaTotal=$venta->total.".00";
  }


//////////////////////////////////////////////////CABECERA DE LA NOTA///////////////////////////////////////////////////
  $pdf->SetXY(182,14);
  $pdf->Cell(70,6,utf8_decode($venta->id),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetXY(175,26);
  $pdf->Cell(70,6,utf8_decode($venta->pago),0,0,'L');
  $pdf->SetXY(35,31);
  $pdf->Cell(70,6,utf8_decode($venta->nombre),0,0,'L');
  $pdf->SetXY(35,36.5);
  $pdf->Cell(70,6,utf8_decode($venta->direccion),0,0,'L');
  $pdf->SetXY(35,42);
  $pdf->Cell(70,6,utf8_decode($venta->rfc),0,0,'L');
  $pdf->SetXY(90,42);
  $pdf->Cell(70,6,utf8_decode($venta->obs),0,0,'L');
  $pdf->SetXY(174,36.5);
  $pdf->Cell(70,6,utf8_decode(str_replace('-','/',date('j-m-Y',strtotime("1 days",strtotime($venta->fecha))))),0,0,'L');
////////////////////////////////////////777//CUERPO DE LA NOTA(CONTENIDO-VENTA)//////////////////////////////////////////////////////
$pdf->SetFont('Arial','',10);
$pdf->SetXY(10,56);
foreach($_SESSION["carrito"] as $indice => $producto){

      $pdf->Cell(20,6,utf8_decode($producto->cantidad),0,"Cell",'C');
      $pdf->Cell(10,6,"",0,"Cell",'C');
      $pdf->Cell(85,6,utf8_decode($producto->pastel),0,"Cell",'L');
      //precio parcial
      $caracter="$producto->p_menudeo";
      if (substr($producto->p_menudeo, -3)==".00") {

      }else {

          if (substr($caracter, -2)==".5"){
            $producto->p_menudeo=$producto->p_menudeo."0";
          }else {
            $producto->p_menudeo=$producto->p_menudeo.".00";
          }
      }
      $pdf->Cell(40,6,utf8_decode("$".$producto->p_menudeo),0,"Cell",'R');
      //totales
      $caracter2="$producto->total";
      if (substr($producto->total, -3)==".00") {

      }else {
          if (substr($caracter2, -2)==".5"){
            $producto->total=$producto->total."0";
          }else {
            $producto->total=$producto->total.".00";
          }
      }
      $pdf->Cell(40,6,utf8_decode("$".$producto->total),0,"Cell",'C');
      $pdf->Ln(4);

}

////////////////////////////////////////////////////////////////////DATOS///////////////////////////////////
$pdf->SetFont('Arial','B',10);
  $pdf->SetXY(20,194);
  $pdf->Cell(70,6,utf8_decode($venta->piezasVen),0,0,'L');
  $pdf->SetXY(178,194);
  $ventaTot="$venta->total";
    if (substr($ventaTot, -2)==".5"){
      $ventaTot=$ventaTot."0";
    }else {
      $ventaTot=$ventaTot.".00";
    }
  $pdf->Cell(70,6,utf8_decode($ventaTot),0,0,'L');
  $entero=substr($ventaTot,0, -3);
  include("conversor.php");
  convertir($entero);

  $pdf->SetXY(45,205);
  $pdf->Cell(70,6,utf8_decode("*".$totalFinal."  PESOS ".$cadena."0/100 M. N.*"),0,0,'L');
  ////////////////////////////////////////////////////////ORIGINAL//////////////////////
  $pdf->SetFont('Arial','B',12);
  $pdf->SetXY(145,215);
  $pdf->SetTextColor(255,0,0);
  $pdf->Cell(70,6,utf8_decode("ORIGINAL"),0,0,'L');
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial','B',10);
  /////////////////////////////////////////////////////////DATOS DEL PAGARE//////////////////////////////////////////////////////7
  $pdf->SetXY(165,241);
  $pdf->Cell(70,6,utf8_decode($ventaTot),0,0,'L');
  $pdf->SetXY(20,249);
  $pdf->Cell(70,6,utf8_decode("*".$totalFinal."  PESOS ".$cadena."0/100 M. N.*"),0,0,'L');

  $pdf->SetXY(15,254);
  $pdf->Cell(70,6,utf8_decode(str_replace('-','/',date('j-m-Y',strtotime($dias,strtotime($venta->fecha))))),0,0,'L');
  //6%
  $pdf->SetXY(170,252);
  $pdf->Cell(70,6,utf8_decode("6"),0,0,'L');
  $pdf->SetXY(165,266);
  $pdf->Cell(70,6,utf8_decode(str_replace('-','/',date('j-m-Y',strtotime('1 days',strtotime($venta->fecha))))),0,0,'L');
  //ULTIMA PARTE DE LA NOTA (NOMBRE Y RFC)
  $pdf->SetFont('Arial','I',9);
  $pdf->SetXY(30,276);
  $pdf->Cell(70,6,utf8_decode($venta->nombre),0,0,'L');
  $pdf->SetXY(30,280);
  $pdf->Cell(70,6,utf8_decode($venta->direccion),0,0,'L');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////HOJA COPIA//////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(180,405);
$pdf->Cell(70,6,utf8_decode($venta->id),0,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(175,26);
$pdf->Cell(70,6,utf8_decode($venta->pago),0,0,'L');
$pdf->SetXY(35,31);
$pdf->Cell(70,6,utf8_decode($venta->nombre),0,0,'L');
$pdf->SetXY(35,36.5);
$pdf->Cell(70,6,utf8_decode($venta->direccion),0,0,'L');
$pdf->SetXY(35,42);
$pdf->Cell(70,6,utf8_decode($venta->rfc),0,0,'L');
$pdf->SetXY(90,42);
$pdf->Cell(70,6,utf8_decode($venta->obs),0,0,'L');
$pdf->SetXY(174,36.5);
$pdf->Cell(70,6,utf8_decode(str_replace('-','/',date('j-m-Y',strtotime("1 days",strtotime($venta->fecha))))),0,0,'L');

//CONTENIDO 2
$pdf->SetFont('Arial','',10);
$pdf->SetXY(10,56);
foreach($_SESSION["carrito"] as $indice => $producto){

      $pdf->Cell(20,6,utf8_decode($producto->cantidad),0,"Cell",'C');
      $pdf->Cell(10,6,"",0,"Cell",'C');
      $pdf->Cell(85,6,utf8_decode($producto->pastel),0,"Cell",'L');
      //precio parcial
      /*
      $caracter="$producto->p_menudeo";
      if (substr($caracter, -2)==".5"){
        $producto->p_menudeo=$producto->p_menudeo."0";
      }else {
        $producto->p_menudeo=$producto->p_menudeo.".00";
      }*/
      $pdf->Cell(40,6,utf8_decode("$".$producto->p_menudeo),0,"Cell",'R');
      //totales
      /*
      $caracter2="$producto->total";
      if (substr($caracter2, -2)==".5"){
        $producto->total=$producto->total."0";
      }else {
        $producto->total=$producto->total.".00";
      }*/
      $pdf->Cell(40,6,utf8_decode("$".$producto->total),0,"Cell",'C');
      $pdf->Ln(4);

}
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(20,194);
$pdf->Cell(70,6,utf8_decode($venta->piezasVen),0,0,'L');
$pdf->SetXY(178,194);
$pdf->Cell(70,6,utf8_decode($ventaTot),0,0,'L');
$pdf->SetXY(45,205);
$pdf->Cell(70,6,utf8_decode("*".$totalFinal."  PESOS ".$cadena."0/100 M. N.*"),0,0,'L');
////////////////////////////////////////////////////////7COPIA////////////////////////////////////////////////////////
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(145,215);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(70,6,utf8_decode("COPIA"),0,0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
//DATOS DEL PAGARE
$pdf->SetXY(165,241);
$pdf->Cell(70,6,utf8_decode($ventaTot),0,0,'L');
$pdf->SetXY(20,249);
$pdf->Cell(70,6,utf8_decode("*".$totalFinal."  PESOS ".$cadena."0/100 M. N.*"),0,0,'L');
$pdf->SetXY(15,254);
$pdf->Cell(70,6,utf8_decode(str_replace('-','/',date('j-m-Y',strtotime($dias,strtotime($venta->fecha))))),0,0,'L');
//6%
$pdf->SetXY(170,252);
$pdf->Cell(70,6,utf8_decode("6"),0,0,'L');
$pdf->SetXY(165,266);
$pdf->Cell(70,6,utf8_decode(str_replace('-','/',date('j-m-Y',strtotime('1 days',strtotime($venta->fecha))))),0,0,'L');
//ULTIMA PARTE DE LA NOTA (NOMBRE Y RFC)
$pdf->SetFont('Arial','I',9);
$pdf->SetXY(30,276);
$pdf->Cell(70,6,utf8_decode($venta->nombre),0,0,'L');
$pdf->SetXY(30,280);
$pdf->Cell(70,6,utf8_decode($venta->direccion),0,0,'L');

}

$pdf->Output("NOTA ".$venta->id.".pdf","D");

 ?>
