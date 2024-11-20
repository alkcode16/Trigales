<?php
require("../fpdf/fpdf.php");
//echo '<link rel="icon" type="image/png" href="../logo 2016.png">';

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

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  $this->Image('../logo 2016.png',10,8,33);
   // Arial bold 15
   $this->SetFont('Arial','B',10);
   // Movernos a la derecha
   $this->Cell(50);
   // Título
   $this->Cell(180,20,utf8_decode('Lista de Precios Trigales de Oro ® '),1,0,'C');
   // Salto de línea
   $this->Ln(20);
   $this->Ln(20);

   //Encabezados
   $this->Cell(10,6,'ID',1,0,'C',0);
   $this->Cell(70,6,'PASTEL',1,0,'C',0);
   $this->Cell(50,6,'LINEA',1,0,'C',0);
   $this->Cell(30,6,'P.MAYOREO',1,0,'C',0);
   $this->Cell(30,6,'P.MEDIO',1,0,'C',0);
   $this->Cell(30,6,'P.EVENTUAL',1,0,'C',0);
   $this->Cell(30,6,'P.TEMPORADA',1,0,'C',0);
   $this->Cell(30,6,'P.MENUDEO',1,1,'C',0);

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
$sql="SELECT * FROM pasteles";
$result=$conexion->query($sql);



$pdf=new PDF("L");
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
//$pdf->Cell(40,10,utf8_decode('¡HOLA CHUY, EFREN Y TODOS'));

while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(10,6,utf8_decode($row['id_producto']),1,0,'C');
    $pdf->Cell(70,6,utf8_decode($row['pastel']),1,0,'C');
    $pdf->Cell(50,6,utf8_decode($row['linea']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['p_mayoreo']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['p_medio']),1,0,'C');
   $pdf->Cell(30,6,utf8_decode($row['p_eventual']),1,0,'C');
   $pdf->Cell(30,6,utf8_decode($row['p_temporada']),1,0,'C');

    $pdf->Cell(30,6,utf8_decode($row['p_menudeo']),1,1,'C');


}

mysqli_close($conexion);

$pdf->Output();


 ?>
