<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
require("../fpdf/fpdf.php");
include_once "../Conexion/base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.piezasVen, ventas.fecha, ventas.id,ventas.nombre,ventas.rfc,ventas.direccion, GROUP_CONCAT(productos_vendidos.cantidad, '..', pasteles.pastel, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC LIMIT 1");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//CABECERA DE DATOS DEL CLIENTE
foreach ($ventas as $venta) {
  $fecha=substr($venta->fecha,0,-9);
  //str_replace('-','/',date('j-m-Y',strtotime('1 day',strtotime($fecha)))))

  $pdf->Ln(8);
  $pdf->Cell(160,6,"                                                                                                                                                                                                                                                                                                                                                                                                                  ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($venta->id),0,0,'C');
  $pdf->Ln(8);
  $pdf->Cell(160,6,"                                                                                                                                                                                                                                                                                                                                                                                                                  ",0,0,'C');
  $pdf->Cell(40,6,"",0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(70,6,utf8_decode("                             ".$venta->nombre),0,0,'L');
  $pdf->Ln(5);
  $pdf->Cell(88,6,utf8_decode("                             ".$venta->direccion."                                                                                                       ".str_replace('-','/',date('j-m-Y',strtotime('1 day',strtotime($fecha))))),0,1,'L');
  //$pdf->Ln(5);
  $pdf->Cell(160,6,utf8_decode("                             ".$venta->rfc),0,0,'L');

  $pdf->Ln(12);

}

foreach(explode("__", $venta->pasteles) as $productosConcatenados){
  $producto=explode("..",$productosConcatenados);

       $pdf->Cell(20,6,utf8_decode($producto[0]),0,"Cell",'C');
       $pdf->Cell(10,6,"",0,"Cell",'C');
       $pdf->Cell(85,6,utf8_decode($producto[1]),0,"Cell",'L');
       $pdf->Cell(40,6,utf8_decode("$".$producto[2]),0,"Cell",'R');
       $pdf->Cell(40,6,utf8_decode("$".$producto[3]),0,"Cell",'C');
       $pdf->Ln(4);

 }

//echo $venta->total;
//echo "<br>";
$caracter=(String)$venta->total;
//echo substr($caracter,-1);
//echo $caracter;
if(substr($caracter,-1)==5) {
  //echo "se la comen";
  $cadena="5";
  $ventaTotal=$venta->total."0";
  //echo $ventaTotal;
  //echo $cadena;

  // code...
}else {
//  echo "no se la comen";
    $cadena="0";
    //echo $cadena;
    $ventaTotal=$venta->total.".00";
    //echo $ventaTotal;
}

include("conversor.php");
convertir($venta->total);

$pdf->Ln(115);
$pdf->Cell(170,6,"       ".$venta->piezasVen."                                                                                                                                                            ".$ventaTotal,0,1,'L');
//$pdf->Cell(60,6,"",0,0,'C');
$pdf->Ln(3);
$pdf->Cell(160,6,"                         *".$totalFinal." PESOS ".$cadena."0/100 M. N.*",0,1,'C');
//$pdf->Cell(140,6,"",0,0,'C');
$pdf->Ln(5);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(160,6,"ORIGINAL  ",0,0,'R');
$pdf->SetTextColor(0,0,0);
//$pdf->Cell(140,6,"  ",0,0,'C');
$pdf->Ln(24);
$pdf->Cell(165,6,utf8_decode("                         ".$ventaTotal),0,1,'R');
$fechaHoyMasUnMes = strtotime ( '+7 days' , strtotime ($venta->fecha) ) ;
$fechaHoyMasUnMes = date ( 'j-m-Y' , $fechaHoyMasUnMes );
$pdf->Cell(60,6,"",0,0,'C');
$pdf->Cell(50,6,"*".$totalFinal." PESOS ".$cadena."0/100 M.N.*",0,1,'C');
$pdf->Cell(180,6,utf8_decode("            ".str_replace('-','/',date('j-m-Y',strtotime('1 day',strtotime($fechaHoyMasUnMes))))."                                                                                                                                 6"),0,1,'L');
$pdf->Ln(5);
$pdf->Cell(140,6,"  ",0,0,'C');
$pdf->Cell(40,6,utf8_decode("                ".str_replace('-','/',date('j-m-Y',strtotime('1 day',strtotime($fecha))))),0,0,'C');
$pdf->Cell(140,6,"  ",0,0,'C');
//DATOS DEL PAGARE
$pdf->SetY(253);
$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,10,"                           ".$venta->nombre,0,0,'L');
$pdf->Ln(4);
$pdf->Cell(0,10,"                           ".$venta->direccion,0,0,'L');
//$pdf->Cell(50,6,utf8_decode($venta->nombre),0,0,'C');
//$pdf->Cell(40,6,utf8_decode($venta->direccion),0,0,'C');
$pdf->Ln(400);

$pdf->Output();
?>
