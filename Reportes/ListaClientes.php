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
   $this->SetFont('Times','',12);
   // Movernos a la derecha
   $this->Cell(50);
   // Título
   $this->Cell(180,20,utf8_decode('Lista de Clientes Trigales de Oro ® '),1,0,'C');
   // Salto de línea
   $this->Ln(20);
   $this->Ln(20);
   $this->SetFont('Times','',10);
   //Encabezados
   $this->Cell(10,6,'ID',1,0,'C',0);
   $this->Cell(80,6,'NOMBRE',1,0,'C',0);
   $this->Cell(40,6,'RFC',1,0,'C',0);
   $this->Cell(100,6,utf8_decode('DIRECCIÓN'),1,0,'C',0);
   $this->Cell(10,6,'CLAS',1,0,'C',0);
   $this->Cell(40,6,'TIPO DE PAGO',1,1,'C',0);

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
$sql="SELECT * FROM clientes";
$result=$conexion->query($sql);



$pdf=new PDF("L");
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
//$pdf->Cell(40,10,utf8_decode('¡HOLA CHUY, EFREN Y TODOS'));

while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(10,6,utf8_decode($row['id_nombre']),1,0,'C');
    $pdf->Cell(80,6,utf8_decode($row['nombre']),1,0,'C');
    $pdf->Cell(40,6,utf8_decode($row['rfc']),1,0,'C');
    $pdf->Cell(100,6,utf8_decode($row['dir']),1,0,'C');

   $pdf->Cell(10,6,utf8_decode($row['clasif']),1,0,'C');

    $pdf->Cell(40,6,utf8_decode($row['tipo_pago']),1,1,'C');


}

mysqli_close($conexion);

$pdf->Output();

 ?>
