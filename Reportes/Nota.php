<?php
require("../fpdf/fpdf.php");
//echo '<link rel="icon" type="image/png" href="../logo 2016.png">';
//require("../Venta/base_de_datos.php");
require("../Conexion/conexion.php");

//$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id,ventas.nombre,ventas.rfc,ventas.direccion, GROUP_CONCAT(productos_vendidos.cantidad, '..', pasteles.pastel, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC LIMIT 1");
//$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sql="SELECT ventas.total, ventas.fecha, ventas.id,ventas.nombre,ventas.rfc,ventas.direccion, GROUP_CONCAT(productos_vendidos.cantidad, '..', pasteles.pastel, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC LIMIT 1";
$result=$conexion->query($sql);
$result2=$conexion->query($sql);
$productos=$conexion->query($sql);
$pasteles=$conexion->query($sql);
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
//CABECERA DE DATOS DEL CLIENTE
while ($row = mysqli_fetch_array($result)){
  $pdf->Ln(5);
  $pdf->Cell(150,6,"                                                                                                                                                                                                                                                                                                                                                                                                                  ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row['id']),0,0,'C');
  $pdf->Ln(8);
  $pdf->Cell(160,6,"                                                                                                                                                                                                                                                                                                                                                                                                                  ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row['fecha']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(70,6,utf8_decode($row['nombre']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(65,6,utf8_decode($row['rfc']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(100,6,utf8_decode($row['direccion']),0,1,'C');
  $pdf->Ln(6);





  foreach (explode("__",utf8_decode($row['pasteles'])) as $productosConcatenados) {
      $producto=explode("..", $productosConcatenados);

        // code...
        $pdf->Cell(30,6,utf8_decode($producto[0]),0,"Cell",'C');
        $pdf->Cell(80,6,utf8_decode($producto[1]),0,"Cell",'C');
        $pdf->Cell(40,6,utf8_decode($producto[2]),0,"Cell",'C');
        $pdf->Cell(40,6,utf8_decode($producto[3]),0,"Cell",'C');
        $pdf->Ln(4);



  }
}

//ORIGINAL O COPIA
$pdf->Ln(180);
$pdf->Cell(130,6,"       ",0,0,'C');
$pdf->Cell(40,6,"ORIGINAL",0,1,'C');
//PAGARE
while ($row2 = mysqli_fetch_array($result2)){
  $pdf->Ln(5);
  $pdf->Cell(140,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row2['total'])."".".00 MX",0,0,'C');
  $pdf->Ln(8);
  $pdf->Cell(138,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,"6",0,0,'C');
  $pdf->Ln(15);
  $pdf->Cell(140,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row2['fecha']),0,0,'C');
  $pdf->Ln(7);
  $pdf->Cell(10,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row2['nombre']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(10,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row2['rfc']),0,0,'C');
}

$pdf->Ln(400);







/*


//HOJA 2 DE LA NOTA(COPIA)
$result3=$conexion->query($sql);
$result4=$conexion->query($sql);
//CABECERA DE DATOS DEL CLIENTE (COPIA)
while ($row3 = mysqli_fetch_array($result3)){
  $pdf->Ln(5);
  $pdf->Cell(160,6,"                                                                                                                                                                                                                                                                                                                                                                                                                  ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row3['id']),0,0,'C');
  $pdf->Ln(8);
  $pdf->Cell(160,6,"                                                                                                                                                                                                                                                                                                                                                                                                                  ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row3['fecha']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(40,6,utf8_decode($row3['nombre']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(40,6,utf8_decode($row3['rfc']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(40,6,utf8_decode($row3['direccion']),0,1,'C');
}
//ORIGINAL O COPIA
$pdf->Ln(180);
$pdf->Cell(130,6,"       ",0,0,'C');
$pdf->Cell(40,6,"COPIA",0,1,'C');
//PAGARE
while ($row4 = mysqli_fetch_array($result4)){
  $pdf->Ln(5);
  $pdf->Cell(140,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row4['total'])."".".00 MX",0,0,'C');
  $pdf->Ln(8);
  $pdf->Cell(138,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,"6",0,0,'C');
  $pdf->Ln(15);
  $pdf->Cell(140,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row4['fecha']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(10,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row4['nombre']),0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(10,6,"                                             ",0,0,'C');
  $pdf->Cell(40,6,utf8_decode($row4['rfc']),0,0,'C');
}
*/
$pdf->Output();


 ?>
