<?php
require("../fpdf/fpdf.php");
//echo '<link rel="icon" type="image/png" href="../logo 2016.png">';
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  $this->Image('../logo 2016.png',10,8,33);
   // Arial bold 15
   $this->SetFont('Arial','B',16);
   // Movernos a la derecha
   $this->Cell(50);
   // Título
   $this->Cell(180,20,utf8_decode('Ventas Totales Del Dia Trigales de Oro ® '),1,0,'C');
   // Salto de línea
   $this->Ln(20);
   $this->Ln(20);
$this->SetFont('Arial','B',10);
   //Encabezados
   $this->Cell(10,6,'ID',1,0,'C',0);
   $this->Cell(70,6,'NOMBRE',1,0,'C',0);
   $this->Cell(50,6,'RFC',1,0,'C',0);
   $this->Cell(80,6,utf8_decode('DIRECCIÓN'),1,0,'C',0);
   $this->Cell(30,6,'PZAS TOTALES',1,0,'C',0);
   $this->Cell(40,6,'TOTAL',1,1,'C',0);

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
$ahora=("Y-m-d  H:i:s");
$dia =date("Y-m-d ");
$hora_min = $dia . ' 00:00:00';
$hora_max = $dia . ' 23:59:59' ;
//$sql=("SELECT ventas.total, ventas.fecha, ventas.id,ventas.nombre,ventas.rfc,ventas.direccion, GROUP_CONCAT(productos_vendidos.cantidad, '..', pasteles.pastel, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC LIMIT 1");
$sql="SELECT id,nombre,rfc,direccion,piezasVen,total FROM ventas WHERE fecha='$ahora'";
$result=$conexion->query($sql);
//select Date_format(now(),'%Y/%M/%d');
$sql2="SELECT SUM(piezasVen) as Total FROM ventas WHERE fecha = '$ahora'";
$result2=$conexion->query($sql2);

$sql3="SELECT SUM(total) as TotalCantidad FROM ventas WHERE fecha = '$ahora'";
$result3=$conexion->query($sql3);
//($dia BETWEEN $hora_min AND $hora_max);
$pdf=new PDF("L");
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
//$pdf->Cell(40,10,utf8_decode('¡HOLA CHUY, EFREN Y TODOS'));

while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(10,6,utf8_decode($row['id']),1,0,'C');
    $pdf->Cell(70,6,utf8_decode($row['nombre']),1,0,'C');
    $pdf->Cell(50,6,utf8_decode($row['rfc']),1,0,'C');
    $pdf->Cell(80,6,utf8_decode($row['direccion']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['piezasVen']),1,0,'C');
    $pdf->Cell(40,6,utf8_decode($row['total']),1,1,'C');


}
 $pdf->Ln(20);

while ($row2 = mysqli_fetch_array($result2)) {
  $pdf->SetFont('Arial','B',10);
    $pdf->Cell(37,6,utf8_decode("Total de pasteles:"),0,0,'C');
    $pdf->Cell(10,6,utf8_decode($row2['Total']),0,0,'C');
}
$pdf->Ln(8);
while ($row3 = mysqli_fetch_array($result3)) {
    $pdf->Cell(70,6,utf8_decode("Cantidad total de las ventas del dia:"),0,0,'C');
    $pdf->Cell(20,6,utf8_decode("$ ".$row3['TotalCantidad']),1,0,'C');
}

$pdf->Output();

//SELECT SUM(piezasVen) as Total FROM ventas WHERE fecha='2019-09-15'

 ?>
