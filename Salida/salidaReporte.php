<?php
require("../fpdf/fpdf.php");

error_reporting(0);
//echo '<link rel="icon" type="image/png" href="../logo 2016.png">';
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  $hoy= date("Y-m-d");
  $fechaRep=str_replace('-','/',date('j-m-Y',strtotime("1 days",strtotime($hoy))));
  //$this->Image('../logo 2016.png',10,8,33);
   // Arial bold 15
   $this->SetFont('Arial','B',10);
   // Movernos a la derecha
   $this->Cell(50);
   // Título
   $this->Cell(100,20,utf8_decode('Salida Trigales de Oro ®'),0,0,'C');
   $this->Cell(20,20,utf8_decode($fechaRep),0,0,'C');
   // Salto de línea
   $this->Ln(15);

   //Encabezados
   $this->Cell(20,6,'',0,0,'C',0);
   $this->Cell(10,6,'ID',1,0,'C',0);
   $this->Cell(70,6,'PASTEL',1,0,'C',0);
   $this->Cell(20,6,'RUTA 1',1,0,'C',0);
   $this->Cell(20,6,'RUTA 2',1,0,'C',0);
   $this->Cell(30,6,'Total de Pastel',1,1,'C',0);

}

// Pie de página
function Footer()
{
   // Posición: a 1,5 cm del final
   $this->SetY(-15);
   // Arial italic 8
   $this->SetFont('Arial','I',7);
   // Número de página
   $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo(),0,0,'C');
}
}

require("../Conexion/conexion.php");
//$sql=("SELECT ventas.total, ventas.fecha, ventas.id,ventas.nombre,ventas.rfc,ventas.direccion, GROUP_CONCAT(productos_vendidos.cantidad, '..', pasteles.pastel, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC LIMIT 1");
$sql="SELECT * FROM pastelesstock WHERE stockRuta1>0 || stockRuta2>0";
$result=$conexion->query($sql);

$sql2="SELECT SUM(stockRuta1) as total FROM pastelesstock";
$result2=$conexion->query($sql2);

$sql3="SELECT SUM(stockRuta2) as total2 FROM pastelesstock";
$result3=$conexion->query($sql3);



$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',7);
//$pdf->Image('../0001.jpg','0','0','210','297','JPG');
//$pdf->Cell(40,10,utf8_decode('¡HOLA CHUY, EFREN Y TODOS'));

while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(20,5,'',0,0,'C',0);
    $pdf->Cell(10,5,utf8_decode($row['id_producto']),1,0,'C');
    $pdf->Cell(70,5,utf8_decode($row['pastel']),1,0,'C');
    if ($row['stockRuta1']==0) {
        $row['stockRuta1']="-";

    }

    if ($row['stockRuta2']==0) {
        $row['stockRuta2']="-";
    }


    $totalPastel=  $row['stockRuta1']+$row['stockRuta2'];
    if ($totalPastel==0) {
          $totalPastel="-";
    }

    $pdf->Cell(20,5,utf8_decode($row['stockRuta1']),1,0,'C');
    $pdf->Cell(20,5,utf8_decode($row['stockRuta2']),1,0,'C');
    $pdf->Cell(30,5,utf8_decode($totalPastel),1,1,'C');

}
   $pdf->Ln(5);
   $pdf->Cell(20,6,'',0,0,'C',0);
$pdf->Cell(80,6,utf8_decode("Total de pasteles por ruta"),1,0,'C');

while ($row2 = mysqli_fetch_array($result2)) {
  $pdf->Cell(20,6,utf8_decode($row2['total']),1,0,'C');
  $total1=$row2['total'];
}

while ($row3 = mysqli_fetch_array($result3)) {
  $pdf->Cell(20,6,utf8_decode($row3['total2']),1,0,'C');
  $total2=$row3['total2'];
}
$final=$total1+$total2;

$pdf->Cell(30,6,utf8_decode($final),1,0,'C');

mysqli_close($conexion);

$hoy2= date("Y-m-d");
$fecha=str_replace('-','/',date('j-m-Y',strtotime("1 days",strtotime($hoy2))));

$pdf->Output("Salida ".$fecha.".pdf","D");
 ?>
